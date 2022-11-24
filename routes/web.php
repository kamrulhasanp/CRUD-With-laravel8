<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Models\User;
use App\Models\Multipic;
use \Illuminate\Support\Facades\DB;
  

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $portfolios = Multipic::all();
    return view('home', compact('brands', 'abouts', 'portfolios') );
});

Route::get('/home', function () {
   //return view('about');
   echo "This is Home Page";
});

Route::get('/about', function () {
    return view('about');
    //echo "This is Home Page";
 })->middleware('check');


Route::get('/contact', [ContactController::class, 'index'])->name('con');

//For category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('category/update/{id}', [CategoryController::class, 'update']);

Route::get('softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('category/restor/{id}', [CategoryController::class, 'Restor']);
Route::get('pdelete/category/{id}', [CategoryController::class, 'Pdelete']);

//For Brand Controller
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('brand/update/{id}', [BrandController::class, 'Update']);
Route::get('brand/delete/{id}', [BrandController::class, 'Delete']);


// For Multi Image route
Route::get('multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multipic/add', [BrandController::class, 'StoreImage'])->name('store.image');


// Admin all route

Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('slider/update/{id}', [HomeController::class, 'Update']);
Route::get('slider/delete/{id}', [HomeController::class, 'Delete']);


//Home About all rout
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('about/edit/{id}', [AboutController::class, 'Edit']);
Route::post('about/update/{id}', [AboutController::class, 'Update']);
Route::get('about/delete/{id}', [AboutController::class, 'Delete']);


// Portfolio Page Route
Route::get('portfollio', [AboutController::class, 'Portfollio'])->name('portfollio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        //user Query Builder
        //$users = DB::table('users')->get();

        //$users = User::all();
        return view('admin.index');
    })->name('dashboard');

});


//For Log out
Route::get('user/logout', [BrandController::class, 'Logout'])->name('user.logout');
