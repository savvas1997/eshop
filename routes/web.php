<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;

use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('admin:admin')->group(function() {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');

});

Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');
});

//Admin All Routes
Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminProfileController::class,'adminprofile'])->name('admin.profile')->middleware('auth:admin');
Route::get('/admin/profile/edit',[AdminProfileController::class,'adminprofileEdit'])->name('admin.profile.edit')->middleware('auth:admin');
Route::post('/admin/profile/store',[AdminProfileController::class,'adminprofilestore'])->name('admin.profile.store');
Route::get('/admin/change/password',[AdminProfileController::class,'adminchangepassword'])->name('admin.change.password');
Route::post('/admin/update/password',[AdminProfileController::class,'adminupdatepassword'])->name('update.change.password');

Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('dashboard',compact('user'));
    })->name('dashboard');
});

Route::get('/',[IndexController::class,'index']);
Route::get('/user/logout',[IndexController::class,'userlogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'userprofile'])->name('user.profile');
Route::post('/user/profile/store',[IndexController::class,'userprofilestore'])->name('user.profile.store');
Route::get('/user/change/password',[IndexController::class,'changepassword'])->name('change.password');
Route::post('/user/password/update',[IndexController::class,'updatepassword'])->name('user.password.update');

//Admin Breand All Route
Route::prefix('brand')->group(function(){
Route::get('/view',[BrandController::class, 'brandview'])->name('all.brand');
Route::post('/store',[BrandController::class,'brandstore'])->name('brand.store');
Route::get('/edit/{id}',[BrandController::class,'brandedit'])->name('edit.brand');
Route::post('/update',[BrandController::class,'brandupdate'])->name('brand.update');
Route::get('/delete/{id}',[BrandController::class,'branddelete'])->name('brand.delete');
});

//Admin Category All Routes
Route::prefix('category')->group(function(){
    Route::get('/view',[CategoryController::class, 'categoryview'])->name('all.category');
    Route::post('/store',[CategoryController::class,'categorystore'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'categoryedit'])->name('edit.category');
    Route::post('/update/{id}',[CategoryController::class,'categoryupdate'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'categorydelete'])->name('category.delete');

    //Sub Category
    Route::get('/sub/view',[SubCategoryController::class, 'subcategoryview'])->name('all.subcategory');
    Route::post('/sub/store',[SubCategoryController::class,'subcategorystore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}',[SubCategoryController::class,'subcategoryedit'])->name('edit.subcategory');
    Route::post('/sub/update',[SubCategoryController::class,'subcategoryupdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}',[SubCategoryController::class,'subcategorydelete'])->name('subcategory.delete');
    // SubSubcategory
    Route::get('/sub/sub/view',[SubCategoryController::class, 'subsubcategoryview'])->name('all.subsubcategory');

    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);

    Route::post('/sub/sub/store',[SubCategoryController::class,'subsubcategorystore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}',[SubCategoryController::class,'subsubcategoryedit'])->name('edit.subsubcategory');
    Route::post('/sub/sub/update',[SubCategoryController::class,'subsubcategoryupdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}',[SubCategoryController::class,'subsubcategorydelete'])->name('subsubcategory.delete');

    });

    //Admin Breand All Route
Route::prefix('product')->group(function(){
    Route::get('/add/product',[ProductController::class, 'addproduct'])->name('add.product');
    Route::get('/manage/product',[ProductController::class, 'manageproduct'])->name('manage.product');

    Route::post('/product/store',[ProductController::class,'productstore'])->name('product-store');
    Route::get('/edit/{id}',[ProductController::class,'editproduct'])->name('edit.product');
    Route::post('/update',[ProductController::class,'productupdate'])->name('product-update');
    Route::get('/delete/{id}',[ProductController::class,'branddelete'])->name('product.delete');
    });