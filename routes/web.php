<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StipeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\Backend\OrderController;




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
Route::middleware(['auth:admin'])->group(function(){



//Admin All Routes
Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminProfileController::class,'adminprofile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminProfileController::class,'adminprofileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store',[AdminProfileController::class,'adminprofilestore'])->name('admin.profile.store');
Route::get('/admin/change/password',[AdminProfileController::class,'adminchangepassword'])->name('admin.change.password');
Route::post('/admin/update/password',[AdminProfileController::class,'adminupdatepassword'])->name('update.change.password');

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
    
        //Admin Product All Route
    Route::prefix('product')->group(function(){
        Route::get('/add/product',[ProductController::class, 'addproduct'])->name('add.product');
        Route::get('/manage/product',[ProductController::class, 'manageproduct'])->name('manage.product');
    
        Route::post('/product/store',[ProductController::class,'productstore'])->name('product-store');
        Route::get('/edit/{id}',[ProductController::class,'editproduct'])->name('edit.product');
        Route::post('/update',[ProductController::class,'productupdate'])->name('product-update');
    
        Route::get('/delete/{id}',[ProductController::class,'productdelete'])->name('product.delete');
    
        Route::post('/update/product/multiimage',[ProductController::class,'multiImageUpdate'])->name('update-product-image');
        Route::post('/update/product/thambnail',[ProductController::class,'thambnailImageUpdate'])->name('update-product-thambnail');
        Route::get('/multiple/delete/{id}',[ProductController::class,'productmultidelete'])->name('product.multiimg.delete');
        Route::get('/inactive/{id}',[ProductController::class,'productinactive'])->name('product.inactive');
        Route::get('/active/{id}',[ProductController::class,'productactive'])->name('product.active');
    
    
        });
            //Admin Slider All Route

        Route::prefix('slider')->group(function(){
            Route::get('/manage/slider',[SliderController::class,'sliderview'])->name('manage.slider');
            Route::post('/store',[SliderController::class,'sliderstore'])->name('slider.store');
            Route::get('/edit/{id}',[SliderController::class,'editslider'])->name('edit.slider');
            Route::get('/delete/{id}',[SliderController::class,'deleteslider'])->name('slider.delete');
            Route::post('/update',[SliderController::class,'sliderupdate'])->name('slider.update');
            Route::get('/inactive/{id}',[SliderController::class,'sliderinactive'])->name('slider.inactive');
            Route::get('/active/{id}',[SliderController::class,'slidertactive'])->name('slider.active');
        });

        Route::prefix('coupons')->group(function(){
            Route::get('/view',[CouponController::class,'couponview'])->name('manage.coupon');
            Route::post('/store',[CouponController::class,'couponstore'])->name('coupon.store');
            Route::get('/edit/{id}',[CouponController::class,'editcoupon'])->name('edit.coupon');
            Route::get('/delete/{id}',[CouponController::class,'deletecoupon'])->name('coupon.delete');
            Route::post('/update',[CouponController::class,'couponupdate'])->name('coupon.update');
            
            
            
        });
        
        Route::prefix('shipping')->group(function(){
            Route::get('/division/view',[ShippingAreaController::class,'shippingview'])->name('manage.division');
            Route::post('/division/store',[ShippingAreaController::class,'divisionstore'])->name('division.store');
            Route::get('/division/edit/{id}',[ShippingAreaController::class,'editdivision'])->name('edit.division');
            Route::get('/division/delete/{id}',[ShippingAreaController::class,'deletedivision'])->name('division.delete');
            Route::post('/division/update/{id}',[ShippingAreaController::class,'divisionupdate'])->name('division.update');
           
            Route::get('/district/view',[ShippingAreaController::class,'districtview'])->name('manage.district');
            Route::post('/district/store',[ShippingAreaController::class,'districtstore'])->name('district.store');
            Route::get('/district/edit/{id}',[ShippingAreaController::class,'editdistrict'])->name('edit.district');
            Route::get('/district/delete/{id}',[ShippingAreaController::class,'deletedistrict'])->name('district.delete');
            Route::post('/district/update/{id}',[ShippingAreaController::class,'districtupdate'])->name('district.update');

            Route::get('/state/view',[ShippingAreaController::class,'stateview'])->name('manage.state');
            Route::post('/state/store',[ShippingAreaController::class,'statestore'])->name('state.store');
            Route::get('/state/edit/{id}',[ShippingAreaController::class,'editstate'])->name('edit.state');
            Route::get('/state/delete/{id}',[ShippingAreaController::class,'deletestate'])->name('state.delete');
            Route::post('/state/update/{id}',[ShippingAreaController::class,'stateupdate'])->name('state.update');
                
          //  Route::get('/statedistrict/ajax/{division_id}', [ShippingAreaController::class, 'GetDistrict']);

           
        });


        Route::prefix('orders')->group(function(){
            Route::get('/pending/orders',[OrderController::class,'pendingorders'])->name('pending.orders');
          
            Route::get('/pending/order/details/{id}',[OrderController::class,'pendingorderdetails'])->name('pending.order.details');
            Route::get('/confirmed/orders/',[OrderController::class,'confirmedorders'])->name('confirm.order');
            Route::get('/processing/orders/',[OrderController::class,'processingorders'])->name('processing.order');
            Route::get('/picked/orders/',[OrderController::class,'pickedorders'])->name('picked.order');
            Route::get('/shipped/orders/',[OrderController::class,'shippedorders'])->name('shipped.order');
            Route::get('/delivered/orders/',[OrderController::class,'deliveredorders'])->name('delivered.order');
            Route::get('/cancel/orders/',[OrderController::class,'cancelorders'])->name('cancel.order');
            Route::get('/pending/confirm/{id}',[OrderController::class,'pendingToconfirm'])->name('pending-confirm');

           

            
            

            
            
            
            
        });



}); //END MIDDLEWARE ADMIN

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

//frontend All Routes
//MultiLanguge all routes

Route::get('/language/greek',[LanguageController::class,'greek'])->name('greek.language');
Route::get('/language/english',[LanguageController::class,'english'])->name('english.language');

Route::get('/product/details/{id}/{slug}',[IndexController::class,'productdetails']);

Route::get('/product/tag/{tag}',[IndexController::class,'tagwiseproduct']);
Route::get('/subcategory/product/{subcat_id}/{slug}',[IndexController::class,'subcatwiseproduct']);
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}',[IndexController::class,'subsubcatwiseproduct']);
//Product View MODAL WITH AJAX
Route::get('/product/view/modal/{id}',[IndexController::class,'productviewAjax']);

Route::post('/cart/data/store/{id}',[CartController::class,'addtocart']);

Route::get('/product/mini/cart',[CartController::class,'addminicart']);
Route::get('/minicart/product-remove/{rowId}',[CartController::class,'removeminicart']);

Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'User'],function(){
    Route::get('/wishlist',[WishlistController::class,'viewWishlist'])->name('wishlist');
    Route::get('/get-wishlist-product',[WishlistController::class,'getwishlist']);
    Route::get('/wishlist-remove/{id}',[WishlistController::class,'removewishlistprodut']);
    Route::post('/stripe/order', [StipeController::class, 'StripeOrder'])->name('stripe.order');
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    Route::get('/my/orders',[AllUserController::class,'myorders'])->name('my.orders');
    Route::get('/order_details/{id}',[AllUserController::class,'orderdetails']);
    Route::get('/invoice_download/{id}',[AllUserController::class,'invoice_download']);



});

Route::post('/add-to-wishlist/{product_id}',[CartController::class,'AddToWishlist']);


Route::get('/mycart',[CartPageController::class,'mycart'])->name('mycart');
Route::get('/get-cart-product',[CartPageController::class,'getcartproduct']);
Route::get('/cart-remove/{rowId}',[CartPageController::class,'cartremove']);
Route::get('/cart-increment/{rowId}',[CartPageController::class,'cartIncrement']);
Route::get('/cart-decrement/{rowId}',[CartPageController::class,'cartDecrement']);

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);

Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

Route::get('/checkout',[CartController::class,'checkoutcreate'])->name('checkout');

Route::get('/district-get/ajax/{division_id}',[CheckoutController::class,'districtgetAjax']);
Route::get('/state-get/ajax/{district_id}',[CheckoutController::class,'stategetAjax']);

Route::post('/checkout/store',[CheckoutController::class,'checkoutstore'])->name('checkout.store');

 




