<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * return category view to show all categories
     */

    public function showCategory(){

        return view('show-categories');
    }

    /**
     * fetch all the categories from the database
     */


    public function getCategories(){
        $categories = Category::get();
        return DataTables::of($categories)->make(true);
    }


    /**
     * create category
     *
     * @param Request $request
     * @return void
     */
    public function createCategory(Request $request)
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        if($request->method()=='GET')
        {
            return view('create-category', compact('categories'));
        }
        if($request->method()=='POST')
        {
            $validator = $request->validate([
                'name'      => 'required',
                'slug'      => 'required|unique:categories',
                'parent_id' => 'nullable|numeric'
            ]);

            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' =>$request->parent_id
            ]);
            return redirect()->route('home')->withSuccess(['Category has been created successfully.']);

        }
    }
}
