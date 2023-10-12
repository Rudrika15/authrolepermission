<?php

use App\Http\Controllers\Admin\AddToCartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LinkVariantController;
use App\Http\Controllers\Admin\OptionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\NotificationController;

use App\Http\Controllers\Admin\OptiongroupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WhishlistController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// category Routes
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/getData', [CompanyController::class, 'getData'])->name('category.getData');
Route::get('/category/edit/{id?}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{id?}', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('/category/export', [CategoryController::class, 'export'])->name('category.export');
Route::get('/category/exportcsv', [CategoryController::class, 'exportcsv'])->name('category.exportcsv');

// optiongroup Routes
Route::get('optionGroup/create', [OptiongroupController::class, 'create'])->name('optionGroup.create');
Route::get('optionGroup/index', [OptiongroupController::class, 'index'])->name('optionGroup.index');
Route::get('optionGroup/getAllData', [OptiongroupController::class, 'getAllData'])->name('optionGroup.getAllData');
Route::post('optionGroup/store', [OptiongroupController::class, 'store'])->name('optionGroup.store');
Route::get('/optionGroup/edit/{id?}', [OptiongroupController::class, 'edit'])->name('optionGroup.edit');
Route::post('/optionGroup/update', [OptiongroupController::class, 'update'])->name('optionGroup.update');
Route::get('/optionGroup/delete/{id?}', [OptiongroupController::class, 'delete'])->name('optionGroup.delete');

// option Routes
Route::get('option/create', [OptionController::class, 'create'])->name('option.create');
Route::get('option/index', [OptionController::class, 'index'])->name('option.index');
Route::get('option/getAllData', [OptionController::class, 'getAllData'])->name('option.getAllData');
Route::post('option/store', [OptionController::class, 'store'])->name('option.store');
Route::get('/option/edit/{id?}', [OptionController::class, 'edit'])->name('option.edit');
Route::post('/option/update', [OptionController::class, 'update'])->name('option.update');
Route::get('/option/delete/{id?}', [OptionController::class, 'delete'])->name('option.delete');
Route::get('option/getOption/{id?}', [OptionController::class, 'getOption'])->name('option.getOption');

// product Routes
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('product/getAllData', [ProductController::class, 'getAllData'])->name('product.getAllData');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id?}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/delete/{id?}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/product/addVarient/{id?}', [ProductController::class, 'addVarient'])->name('product.addVarient');
Route::post('product/storeProductVarient', [ProductController::class, 'storeProductVarient'])->name('product.storeProductVarient');
Route::get('product/getStockAndPrice/{productGroupId}', [ProductController::class,'getStockAndPrice'])->name('getStockAndPrice');
Route::get('product/deleteProductStockPrice/{id?}', [ProductController::class, 'deleteProductStockPrice'])->name('deleteProductStockPrice');
Route::get('product/deleteProductGallery/{id?}', [ProductController::class, 'deleteProductGallery'])->name('deleteProductGallery');

Route::get('/product/checkProductExists/{productGroupId}',[ProductController::class,'checkProductExists'])->name('checkProductExists');



Route::get('product/getAllproductVarient/{productId?}', [ProductController::class, 'getAllproductVarient'])->name('product.getAllproductVarient');







// slider Routes
Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
Route::get('slider/index', [SliderController::class, 'index'])->name('slider.index');
Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
Route::get('slider/delete/{id?}', [SliderController::class, 'destroy'])->name('slider.delete');

// About Routes
Route::get('about/create', [AboutController::class, 'create'])->name('about.create');
Route::get('about/index', [AboutController::class, 'index'])->name('about.index');
Route::post('about/store', [AboutController::class, 'store'])->name('about.store');
Route::get('about/delete/{id?}', [AboutController::class, 'destroy'])->name('about.delete');

// link variant Routes
Route::get('link/create', [LinkVariantController::class, 'create'])->name('link.create');
Route::get('link/index', [LinkVariantController::class, 'index'])->name('link.index');
Route::post('link/store', [LinkVariantController::class, 'store'])->name('link.store');
Route::get('link/delete/{id?}', [LinkVariantController::class, 'delete'])->name('link.delete');

// cart Routes
Route::get('cart/index', [AddToCartController::class, 'index'])->name('cart.index');
Route::get('cart/getAllData', [AddToCartController::class, 'getAllData'])->name('cart.getAllData');

// notification Routes
Route::get('notification/index', [NotificationController::class, 'index'])->name('notification.index');
Route::get('notification/getAllData', [NotificationController::class, 'getAllData'])->name('notification.getAllData');

// review Routes
Route::get('review/index', [ReviewController::class, 'index'])->name('review.index');
Route::get('review/getAllData', [ReviewController::class, 'getAllData'])->name('review.getAllData');

// rating Routes
Route::get('rating/index', [RatingController::class, 'index'])->name('rating.index');
Route::get('rating/getAllData', [RatingController::class, 'getAllData'])->name('rating.getAllData');

// wishlist Routes
Route::get('whishlist/index', [WhishlistController::class, 'index'])->name('wish.index');
Route::get('whishlist/getAllData', [WhishlistController::class, 'getAllData'])->name('wish.getAllData');

// visitor

Route::get('visitor/product', [ControllersVisitorProductController::class,'productview']);