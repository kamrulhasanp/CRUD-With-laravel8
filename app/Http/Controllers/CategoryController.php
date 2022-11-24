<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function AllCat(){

        $categories = Category::latest()->paginate(10);
        $trashCat = Category::onlyTrashed()->latest()->paginate(5);
        //$categories = Category::latest()->get();

        //$categories = DB::table('categories')->latest()->get();
        //$categories = DB::table('categories')->latest()->paginate(10);

        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'user_id' )
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(10);

        return view('admin.category.index', compact('categories', 'trashCat'));
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
       
    }

    public function Edit($id){
        // $categories = Category::find($id);
        $categories =DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id){
        // $update = Category::find($id)->update([
        //     'category_name'=> $request->category_name,
        //     'user_id'=> Auth::user()->id

        // ]);

        $data = array();
        $data['category_name'] =  $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data); 

        return Redirect()->route('all.category')->with('success', 'Category Updates Successfully');
       
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('Success', 'Category Delete Successfully');
    }

    public function Restor($id){
        $pdelete = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('Success', 'Category Restored Successfully');

    }

    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('Success', 'Category permanently Deleted Successfully');

    }
}
