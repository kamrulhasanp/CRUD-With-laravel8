<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;
use Auth;



use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function AllBrand(){
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand( Request $request ){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => 'Please Input Brand name',
            'brand_image.min' => 'Brand Longer then 4 Characters',
        ]);

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_image = $up_location.$img_name;
        // $brand_image->move($up_location, $img_name);

                //using introduction
        
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_image = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' =>$request->brand_name,
            'brand_image' =>$last_image,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));

    }

    public function Update(Request $request, $id){
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4',
           
        ],
        [
            'brand_name.required' => 'Please Input Brand name',
            'brand_image.min' => 'Brand Longer then 4 Characters',
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_image = $up_location.$img_name;
            $brand_image->move($up_location, $img_name);
          
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' =>$request->brand_name,
                'brand_image' =>$last_image,
                'created_at' =>Carbon::now()
            ]);
    
            return Redirect()->back()->with('success', 'Brand Updated Successfully');

        }else{
            Brand::find($id)->update([
                'brand_name' =>$request->brand_name,
                'created_at' =>Carbon::now()
            ]);
    
            return Redirect()->back()->with('success', 'Brand Updated Successfully');


        }

    }

    public function Delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }

    // This is for Multi Image all Method

    public function Multipic(){
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImage(Request $request ){

        $image = $request->file('image');

        foreach($image as $multi_image){
        
        $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
        Image::make($multi_image)->resize(300,300)->save('image/multi/'.$name_gen);

        $last_image = 'image/multi/'.$name_gen;

        Multipic::insert([
            'image' =>$last_image,
            'created_at' =>Carbon::now()
        ]);

        }

        return Redirect()->back()->with('success', 'Multi Image Inserted Successfully');

    }

    public function Logout(){
        Auth::Logout();
        return Redirect()->route('login')->with('success', 'User Logout');
    }
}
