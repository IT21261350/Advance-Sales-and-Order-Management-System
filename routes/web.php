<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FreeIssueController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Customer's Route

Route::get('/cView', [CustomerController::class, 'cView']) -> name('customer.cView');
Route::get('/cView/CustomerRegistration', [CustomerController::class, 'CustomerRegistration']) -> name('customer.CustomerRegistration');
Route::post('/cView', [CustomerController::class, 'store']) -> name('customer.store');
Route::get('/cView/{customer}/edit', [CustomerController::class, 'edit']) -> name('customer.edit');
Route::put('/cView/{customer}/update', [CustomerController::class, 'update']) -> name('customer.update');
Route::delete('/cView/{customer}/delete', [CustomerController::class, 'delete']) -> name('customer.delete');

//Product's Route

Route::get('/pView', [ProductController::class, 'pView']) -> name('product.pView');
Route::get('/pView/ProductRegistration', [ProductController::class, 'ProductRegistration']) -> name('product.ProductRegistration');
Route::post('/pView', [ProductController::class, 'store']) -> name('product.store');
Route::get('/pView/{product}/edit', [ProductController::class, 'edit']) -> name('product.edit');
Route::put('/pView/{product}/update', [ProductController::class, 'update']) -> name('product.update');
Route::delete('/pView/{product}/delete', [ProductController::class, 'delete']) -> name('product.delete');

//FreeIssue's Route

Route::get('/fView', [FreeIssueController::class, 'fView']) -> name('freeissue.fView');
Route::get('/fView/FreeIssue', [FreeIssueController::class, 'FreeIssue']) -> name('freeissue.FreeIssue');
Route::post('/fView', [FreeIssueController::class, 'store']) -> name('freeissue.store');
Route::get('/fView/{freeissue}/edit', [FreeIssueController::class, 'edit']) -> name('freeissue.edit');
Route::put('/fView/{freeissue}/update', [FreeIssueController::class, 'update']) -> name('freeissue.update');
Route::delete('/fView/{freeissue}/delete', [FreeIssueController::class, 'delete']) -> name('freeissue.delete');

//Order's Route

Route::get('/oView', [OrderController::class, 'oView']) -> name('order.oView');
Route::get('/oView/placingOrder', [OrderController::class, 'placingOrder']) -> name('order.placingOrder');
// getProductCode's routes
Route::post('/oView/placingOrder/getProductCode', [OrderController::class, 'getProductCode'])->middleware('web');
Route::post('/oView/placingOrder/getProductCode', [OrderController::class, 'getProductCode'])->name('order.getProductCode');
// getProductPrice's routes
Route::post('/oView/placingOrder/getProductPrice', [OrderController::class, 'getProductPrice'])->middleware('web');
Route::post('/oView/placingOrder/getProductPrice', [OrderController::class, 'getProductPrice'])->name('order.getProductPrice');
// getDiscountLimit's routes
Route::post('/oView/placingOrder/getDiscountLimit', [OrderController::class, 'getDiscountLimit'])->middleware('web');
Route::post('/oView/placingOrder/getDiscountLimit', [OrderController::class, 'getDiscountLimit'])->name('order.getDiscountLimit');
// getOrderDiscount's routes
Route::post('/oView/placingOrder/getProductDiscount', [OrderController::class, 'getProductDiscount'])->middleware('web');
Route::post('/oView/placingOrder/getProductDiscount', [OrderController::class, 'getProductDiscount'])->name('order.getProductDiscount');
// getFreeQuantity's routes
Route::post('/oView/placingOrder/getFreeQuantity', [OrderController::class, 'getFreeQuantity'])->middleware('web');
Route::post('/oView/placingOrder/getFreeQuantity', [OrderController::class, 'getFreeQuantity'])->name('order.getFreeQuantity');
// getLowerLimit's routes
Route::post('/oView/placingOrder/getLowerLimit', [OrderController::class, 'getLowerLimit'])->middleware('web');
Route::post('/oView/placingOrder/getLowerLimit', [OrderController::class, 'getLowerLimit'])->name('order.getLowerLimit');
// getUpperLimit's routes
Route::post('/oView/placingOrder/getUpperLimit', [OrderController::class, 'getUpperLimit'])->middleware('web');
Route::post('/oView/placingOrder/getUpperLimit', [OrderController::class, 'getUpperLimit'])->name('order.getUpperLimit');
Route::post('/oView', [OrderController::class, 'store']) -> name('order.store');
// Converting to Excel
Route::post('/oView/convertEx', [OrderController::class, 'convertEx']) -> name('order.convertEx');

//Order view's Route

Route::get('/orderView', [OrderController::class, 'orderView']) -> name('oRder.orderView');
Route::post('/orderView/generate-pdf-order', [OrderController::class, 'generatePDFs'])->name('oRder.generate.pdf');
Route::post('/orderView/generate-pdf-summary', [OrderController::class, 'generatePDFsSummary'])->name('oRder.generate.summary');


//Order Detailed view's Route
Route::get('/detailedView/{orderCode}', [OrderController::class, 'detailedView']) -> name('oRder.detailedView');

//Discount's routes
Route::get('/discountView', [OrderController::class, 'discountView']) -> name('oRder.discountView');
Route::get('/discountView/Discount', [OrderController::class, 'Discount']) -> name('oRder.Discount');
Route::post('/discountView', [OrderController::class, 'disStore']) -> name('oRder.disStore');
Route::get('/discountView/{discount}/edit', [OrderController::class, 'edit']) -> name('oRder.edit');
Route::put('/discountView/{discount}/update', [OrderController::class, 'update']) -> name('oRder.update');
Route::delete('/discountView/{discount}/delete', [OrderController::class, 'delete']) -> name('oRder.delete');


