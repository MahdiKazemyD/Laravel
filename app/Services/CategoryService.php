<?php

namespace App\Services;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function create($request)
    {
        return Category::create([
            'name'      => $request->name,
            'user_id'   => Auth::user()->id,
            'parent_id' => $request->parent_id,
        ])->load('parent');
    }

    public function update($category,$request)
    {
        if (Auth::user()->id == $category->user_id){
            $category->update([
                'name'      => $request->name,
                'user_id'   => Auth::user()->id,
                'parent_id' => $request->parent_id,
            ]);
        return $category;
        }

        return response([
            'massage' => 'شما نمیتونید این دسته بندی را بروزرسانی کنید!',
            'status'  => 'error',
        ]);
    }

    public function destroy($category)
    {
        if (Auth::user()->id == $category->user_id) {
        if ($category->children->isEmpty() && $category->products->isEmpty()) {
            $category->delete();
            return response([
                'massage' => 'دسته بندی با موفقیت پاک شد',
                'status'  => 'success' ]);
        } else {
            return response([
                'massage' => 'این دسته بندی دارای زیردسته و محصول است',
                'status'  => 'error',
            ]);
        }
        }
            return response([
                'massage' => 'شما اجازه حذف این دسته بندی را ندارید!',
                'status'  => 'error',
            ]);
    }
}
