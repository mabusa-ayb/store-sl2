<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PDFController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
//Store Front Routes
//Route::get('/', 'PageController@index');
Route::get('/', 'OganiController@index');

Route::get('/shop', 'CartController@shop')->name('shop');
Route::get('/cart', 'CartController@cart')->name('cart.index');
Route::post('/clear', 'CartController@clear')->name('cart.clear');
Route::post('/add', 'CartController@add')->name('cart.store');
Route::post('/update', 'CartController@update')->name('cart.update');
Route::post('/remove', 'CartController@remove')->name('cart.remove');
Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');
Route::get('/productcategory/{id}', 'PageController@category')->name('productcategory');
Route::get('/onlineproducts/{id}', 'PageController@item')->name('onlineproducts');
//End Store Front Routes

//Ogani routes
Route::get('/ogani', 'OganiController@index')->name('ogani');
Route::get('/ogani-shop', 'OganiController@shop')->name('ogani-shop');
Route::get('/ogani-item/{id}', 'OganiController@item')->name('ogani-item');
Route::get('/ogani-category/{id}', 'OganiController@category')->name('ogani-category');
Route::get('/ogani-contact', 'OganiController@contact')->name('ogani-contact');
Route::post('/ogani-contact','OganiController@handleForm');
Route::get('/ogani-cart', 'OganiController@cart')->name('ogani-cart');
Route::post('/ogani-update', 'OganiController@update')->name('ogani-update');
Route::post('/ogani-clear', 'OganiController@clear')->name('ogani-clear');
Route::post('/ogani-remove', 'OganiController@remove')->name('ogani-remove');
Route::post('/ogani-add', 'OganiController@add')->name('ogani-add');
Route::get('/ogani-checkout', 'OganiController@checkout')->name('ogani-checkout');
Route::post('/ogani-search', 'OganiController@search')->name('ogani-search');
Route::post('/ogani-order', 'OganiController@order')->name('ogani-order');
Route::get('/ogani-complete/{email}', 'OganiController@complete')->name('ogani-complete');
//

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('role:admin');

//customer profile admin
Route::get('profile', 'CustomersController@index')->name('profile')->middleware('role:user');
Route::get('profiles/datatable/{email}', 'CustomersController@datatable')->name('profiles/datatable')->middleware('role:user');
Route::get('profile/order/{id}', 'CustomersController@show')->name('profile/order')->middleware('role:user');
Route::get('profile/orders/datatable/{id}', 'CustomersController@datatableOrder')->name('profile/orders/datatable')->middleware('role:user');
Route::get('profile/details', 'CustomersController@edit')->name('profile/details')->middleware('role:user');
//Route::put('profile/update/{id}', 'CustomersController@update')->name('profile/update')->middleware('role:user');
Route::resource('user-details', 'CustomersController')->middleware('role:user');
Route::get('profile/logout', 'Auth\LoginController@logout');

Route::resource('admin/users', 'Admin\UsersController')->middleware('role:admin');
Route::get('users/datatable', 'Admin\UsersController@datatable')->name('users/datatable')->middleware('role:admin');

Route::resource('admin/business', 'Admin\ShopController')->middleware('role:admin');

Route::resource('master/vendor','Master\VendorController')->middleware('role:admin');
Route::get('vendor/datatable', 'Master\VendorController@datatable')->name('vendor/datatable')->middleware('role:admin');

Route::resource('master/product','Master\ProductController')->middleware('role:admin');
Route::get('product/datatable', 'Master\ProductController@datatable')->name('product/datatable')->middleware('role:admin');
Route::get('product/datatableTrash', 'Master\ProductController@datatableTrash')->name('product/datatableTrash')->middleware('role:admin');
Route::post('product/undoTrash/{id}', 'Master\ProductController@undoTrash')->name('product/undoTrash/{id}')->middleware('role:admin');
Route::get('master/product/history/{id}', 'Master\ProductController@history')->name('master/product/history/{id}')->middleware('role:admin');

Route::resource('transaction/purchase-order', 'Transaction\PurchaseController')->middleware('role:admin');
Route::get('transaction/purchase-order/vendor/popup_media', 'Transaction\PurchaseController@popup_media_vendor')->name('transaction/purchase-order/vendor/popup_media')->middleware('role:admin');
Route::get('transaction/purchase-order/product/popup_media/{id_count}', 'Transaction\PurchaseController@popup_media_product')->name('transaction/purchase-order/product/popup_media/{id_count}')->middleware('role:admin');
Route::get('browse-product/datatable', 'Master\ProductController@datatable_product')->name('browse-product/datatable')->middleware('role:admin');
Route::get('browse-vendor/datatable', 'Master\VendorController@datatable_vendor')->name('browse-vendor/datatable')->middleware('role:admin');
Route::get('purchase-order/datatable', 'Transaction\PurchaseController@datatable')->name('purchase-order/datatable')->middleware('role:admin');
Route::post('transaction/purchase-order/receive/{id}', 'Transaction\PurchaseController@received')->name('transaction/purchase-order/receive/{id}')->middleware('role:admin');
Route::get('transaction/purchase-order/print/{id}', 'Transaction\PurchaseController@print')->name('transaction/purchase-order/print/{id}')->middleware('role:admin');

Route::resource('transaction/sales', 'Transaction\SaleController');
Route::get('transaction/sales/product/popup_media/{id_count}', 'Transaction\SaleController@popup_media_product')->name('transaction/sales/product/popup_media/{id_count}')->middleware('role:admin');
Route::get('sales/datatable', 'Transaction\SaleController@datatable')->name('sales/datatable')->middleware('role:admin');
Route::get('transaction/sales/print/{id}', 'Transaction\SaleController@print')->name('transaction/sales/print/{id}')->middleware('role:admin');

Route::get('transaction/stock', 'Transaction\StockController@index')->name('transaction/stock')->middleware('role:admin');
Route::get('/transaction/stock/product/popup_media', 'Transaction\StockController@popup_media_product')->name('/transaction/stock/product/popup_media')->middleware('role:admin');
Route::post('transaction/stock', 'Transaction\StockController@update')->name('transaction/stock')->middleware('role:admin');

Route::get('reports/stocks/report', 'Transaction\StockController@report')->name('reports/stocks/report')->middleware('role:admin');

//Online Store Product-Categories Routes
Route::resource('onlinestore/product/category','ProductCategoriesController')->middleware('role:admin');
Route::get('category/datatable', 'ProductCategoriesController@datatable')->name('category/datatable');

//Online Store Product Routes
Route::resource('onlinestore/product/onlineproduct','OnlineProductsController')->middleware('role:admin');
Route::get('onlineproduct/datatable', 'OnlineProductsController@datatable')->name('onlineproduct/datatable');

//Online Store Sales Routes
Route::resource('onlinestore/onlinetransactions/onlinesales','OnlineTransactionsController')->middleware('role:admin');
Route::get('onlinetransactions/datatable', 'OnlineTransactionsController@datatable')->name('onlinetransactions/datatable')->middleware('role:admin');

//Comment Routes
Route::resource('comments', 'CommentsController');
