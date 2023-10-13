<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function create($request)
    {

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status,
            'score'       => $request->score,
            'user_id'     => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);
        $product->load('category', 'media');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $request->title . rand(1,99) . '.' .$image->getClientOriginalExtension() ;
            $image->storeAs('Image' , $imagePath );

            Media::create([
                'product_id' => $product->id,
                'title'      => $request->title,
                'image'      => $imagePath ,
                'size'       => $request->file('image')->getsize(),
            ]);
        }

        return $product ;
    }

    public function update($product, $request)
    {
        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'status'      => $request->status,
            'score'       => $request->score,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasfile('image')) {
            foreach ($product->media as $media) {
                $media->delete();
            }
            $image     = $request->file('image');
            $imagePath = $image->store('images');

            Media::create([
                'product_id' => $product->id,
                'title'      => $request->title,
                'image'      => $imagePath,
                'size'       => $request->file('image')->getsize() ,
            ]);
        }

        return $product ;
    }

    public function destroy($product)
    {
        if ($product && Auth::user()->id == $product->user_id) {

            foreach ($product->media as $media) {
                //deleted in host//
                Storage::delete($media->image);
                $media->delete();
            }

            $product->delete();
            return response([
                'message' => 'محصول حذف شد!',
                'status'  => 'success'
            ]);
        }
        return response([
            'message' => 'محصول مورد نظر وجود ندارد!',
            'status'  => 'error'
        ]);
    }
}
