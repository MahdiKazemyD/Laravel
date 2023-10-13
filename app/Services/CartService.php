<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function create($request)
    {
        $cart = Cart::create([
            'product_id'  => $request->product_id,
            'user_id'     => Auth::user()->id,
            'number'      => $request->number,
            'total_price' => Product::find($request->product_id)->price,
            'status'      => $request->status,
        ])->load('product');
        $cart->load('user');

        return $cart;
    }

    public function update($cart, $request)
    {
        if (Auth::user()->id == $cart->user_id){
            $cart->update([
                'number'     => $request->number,
                'status'     => $request->status,
                'product_id' => $request->product_id,
            ]);
            $data = $cart->load('product');
            return $data;
        }

        return response([
            'massage' => 'شما نمیتونید این سبد خرید را بروزرسانی کنید!',
            'status'  => 'error',
        ]);

    }

    public function destroy($cart)
    {
        if (Auth::user()->id == $cart->user_id){
            $cart->delete();
            return response([
                'message' => 'سبد خرید حذف شد!',
                'status'  => 'success'
            ]);
        }
        return response([
            'message' => 'شما اجازه حذف این سبد خرید را ندارید!',
            'status'  => 'error'
        ]);
    }
}
