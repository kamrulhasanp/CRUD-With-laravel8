<?php
namespace App\Http\Controllers;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function HomeAbout(){
        $homeabout = HomeAbout::latest()->get();
        return view('admin.about.index', compact('homeabout'));
    }

    public function AddAbout(){
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request){
   
        HomeAbout::insert([
            'title' =>$request->title,
            'short_dis' =>$request->short_dis,
            'long_dis' =>$request->long_dis,
            'created_at' =>Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success', 'About Inserted Successfully');
    }

    public function Edit($id){
        $abouts = HomeAbout::find($id);
        return view('admin.about.edit', compact('abouts'));
        
    }

    public function Update(Request $request, $id){
        $update = HomeAbout::find($id)->update([
            'title' =>$request->title,
            'short_dis' =>$request->short_dis,
            'long_dis' =>$request->long_dis
        ]);

        return Redirect()->route('home.about')->with('success', 'About Updated Successfully');
    }

    public function Delete($id){
        $delate = HomeAbout::find($id)->Delete();
        return Redirect()->back()->with('success', 'About Deleted Successfully');
    }

    public function Portfollio(){
        $portfolios = Multipic::all();
        return view('pages.portfollio', compact('portfolios'));
    }


}
