<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function blogCategories()
    {
        return view('admin.categories.blog');
    }

    public function getCategories($type)
    {
        if ($type == 'blog'){
            $categories = Category
                ::whereSort('blog')
                ->where('parent_id' , null)
                ->first();

            $categories = $categories->childrenRecursive;
        }





        $response = [
            'categories' => $categories
        ];

        return response()->json($response , 200);
    }

    public function deleteCategories(Request $request)
    {
        $forDeleteCategory = $request->itemsForDelete;

        $forDeleteCategoryIds = allChildren([$forDeleteCategory]);


        Category::whereIn('id' , $forDeleteCategoryIds)->delete();
    }
}
