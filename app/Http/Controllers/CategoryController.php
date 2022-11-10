<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){

        //$categories = Category::latest()->paginate(10);
        //$categories = Category::latest()->get();

        //$categories = DB::table('categories')->latest()->get();
        //$categories = DB::table('categories')->latest()->paginate(10);

        $categories = DB::table('categories')
            ->join('users', 'categories.user_id', 'user_id' )
            ->select('categories.*', 'users.name')
            ->latest()->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    public function AddCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please Input category name',
            'category_name.max' => 'Please Input category name less then 255',
        ]);

        ///First Way

        Category::insert([
            'category_name' =>$request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' =>Carbon::now(),

        ]);

        //Secound way 'recommended'

        // $category =new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id =  Auth::user()->id;
        // $category->save();

        //third way query

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category Inserted Successfully');
        //link for seach
        // https://github.com/mbere250/Simple-search-with-pagination-in-laravel-8/blob/master/app/Http/Controllers/SearchController.php


    }
}
