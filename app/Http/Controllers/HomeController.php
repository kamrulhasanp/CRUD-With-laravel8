<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders') );
    }

    public function AddSlider(){
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){
   
        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'. $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_image = 'image/slider/'.$name_gen;

        Slider::insert([
            'title' =>$request->title,
            'description' =>$request->description,
            'image' =>$last_image,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');
    }

    public function Edit($id){
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function Update(Request $request, $id){

        $old_image = $request->old_image;
        $slider_image = $request->file('image');

        if($slider_image){
            $name_gen = hexdec(uniqid()).'.'. $slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

            $last_image = 'image/slider/'.$name_gen;

        unlink ($old_image);

        Slider::find($id)->update([
            'title' =>$request->title,
            'description' =>$request->description,
            'image' =>$last_image,
            'created_at' =>Carbon::now()
        ]);
        return Redirect()->route('home.slider')->with('success', 'Slider Updated Successfully');

        } else{

            Slider::find($id)->update([
                'title' =>$request->title,
                'description' =>$request->description,
                'created_at' =>Carbon::now()
            ]);
            return Redirect()->route('home.slider')->with('success', 'Slider updated Successfully');

        }

    }

    public function Delete($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }
}
