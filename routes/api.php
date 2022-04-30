<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GuaranteeController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'showAll']);
    Route::get('/{id}', [ShopController::class, 'show'])->whereNumber('id');
    Route::post('/create', [ShopController::class, 'create']);
    Route::post('/{id}/update', [ShopController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [ShopController::class, 'delete'])->whereNumber('id');
    Route::delete('/{id}/workers', [ShopController::class, 'deleteWorkers'])->whereNumber('id');
});

Route::prefix('worker')->group(function () {
    Route::get('/', [WorkerController::class, 'showAll']);
    Route::get('/{id}', [WorkerController::class, 'show'])->whereNumber('id');

    Route::get('/shop/{shopId}', [WorkerController::class, 'getWorkersByShop'])->whereNumber('shopId');
    Route::get('/shop/{shopId}/speciality/{specialityId}', [WorkerController::class, 'getWorkersByShopAndSpeciality'])->whereNumber('shopId');
    Route::post('/shop/{shopId}/speciality/{specialityId}/create', [WorkerController::class, 'create'])->whereNumber('shopId')->whereNumber('specialityId');
    Route::post('/{id}/update', [WorkerController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [WorkerController::class, 'delete'])->whereNumber('id');
});

Route::prefix('worker-speciality')->group(function () {
    Route::get('/', [SpecialityController::class, 'showAll']);
    Route::get('/{id}', [SpecialityController::class, 'show'])->whereNumber('id');

    Route::post('/create', [SpecialityController::class, 'create']);
    Route::post('/{id}/update', [SpecialityController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [SpecialityController::class, 'delete'])->whereNumber('id');
    Route::delete('/{id}/workers', [SpecialityController::class, 'deleteWorkers'])->whereNumber('id');
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'showAll']);
    Route::get('/{id}', [ProductController::class, 'show'])->whereNumber('id');

    Route::get('/category/{categoryId}', [ProductController::class, 'getProductsByCategoryId'])->whereNumber('categoryId');
    Route::post('/category/{categoryId}/create', [ProductController::class, 'createWithCategory'])->whereNumber('categoryId');
    Route::post('/{id}/category/{categoryId}/update', [ProductController::class, 'updateWithCategory'])->whereNumber('categoryId')->whereNumber('id');

    Route::get('/category/{categoryId}/manufacturer/{manufacturerId}/guarantee/{guarantee}', [ProductController::class, 'getProductsByCategoryIdAndManufacturerIdAndGuaranteeId'])->whereNumber('categoryId')->whereNumber('manufacturerId')->whereNumber('guaranteeId');
    Route::get('/category/{categoryId}/manufacturer/{manufacturerId}', [ProductController::class, 'getProductsByCategoryIdAndManufacturerId'])->whereNumber('categoryId')->whereNumber('manufacturerId');

    Route::post('/category/{categoryId}/manufacturer/{manufacturerId}/guarantee/{guarantee}/create', [ProductController::class, 'createWithCategoryAndManufacturerAndGuarantee'])->whereNumber('categoryId')->whereNumber('manufacturerId')->whereNumber('guaranteeId');
    Route::post('/create', [ProductController::class, 'create']);
    Route::post('/{id}/update', [ProductController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [ProductController::class, 'delete'])->whereNumber('id');
});

Route::prefix('product-manufacturer')->group(function () {
    Route::get('/', [ManufacturerController::class, 'showAll']);
    Route::get('/{id}', [ManufacturerController::class, 'show'])->whereNumber('id');
    Route::get('/{id}/products', [ManufacturerController::class, 'showProducts'])->whereNumber('id');

    Route::post('/create', [ManufacturerController::class, 'create']);
    Route::post('/{id}/update', [ManufacturerController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [ManufacturerController::class, 'delete'])->whereNumber('id');
    Route::delete('/{id}/products', [ManufacturerController::class, 'deleteProducts'])->whereNumber('id');
});

Route::prefix('product-category')->group(function () {
    Route::get('/', [CategoryController::class, 'showAll']);
    Route::get('/{id}', [CategoryController::class, 'show'])->whereNumber('id');
    Route::get('/{id}/products', [CategoryController::class, 'showProducts'])->whereNumber('id');

    Route::post('/create', [CategoryController::class, 'create']);
    Route::post('/{id}/update', [CategoryController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [CategoryController::class, 'delete'])->whereNumber('id');
    Route::delete('/{id}/products', [CategoryController::class, 'deleteProducts'])->whereNumber('id');
});

Route::prefix('product-guarantee')->group(function () {
    Route::get('/', [GuaranteeController::class, 'showAll']);
    Route::get('/{id}', [GuaranteeController::class, 'show'])->whereNumber('id');
    Route::get('/{id}/products', [GuaranteeController::class, 'showProducts'])->whereNumber('id');

    Route::post('/create', [GuaranteeController::class, 'create']);
    Route::post('/{id}/update', [GuaranteeController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [GuaranteeController::class, 'delete'])->whereNumber('id');
    Route::delete('/{id}/products', [GuaranteeController::class, 'deleteProducts'])->whereNumber('id');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'showAll']);
    Route::get('/{id}', [CartController::class, 'show'])->whereNumber('id');

    Route::post('/create', [CartController::class, 'create']);
    Route::post('/{id}/update', [CartController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [CartController::class, 'delete'])->whereNumber('id');
    Route::delete('/{id}/cart-items', [CartController::class, 'deleteCartItems'])->whereNumber('id');
});

Route::prefix('cart-item')->group(function () {
    Route::get('/', [CartItemController::class, 'showAll']);
    Route::get('/{id}', [CartItemController::class, 'show'])->whereNumber('id');

    Route::get('/cart/{cartId}', [CartItemController::class, 'getCartItemsFromCart'])->whereNumber('cartId');
    Route::get('/cart/{cartId}/product/{productId}', [CartItemController::class, 'getProductAndCartItemsFromCart'])->whereNumber('cartId')->whereNumber('productId');

    Route::post('/cart/{cartId}/product/{productId}/create', [CartItemController::class, 'createWithCart'])->whereNumber('cartId')->whereNumber('productId');
    Route::post('/cart/{cartId}/update', [CartItemController::class, 'updateWithCart'])->whereNumber('cartId');

    Route::post('/create', [CartItemController::class, 'create']);
    Route::post('/{id}/update', [CartItemController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [CartItemController::class, 'delete'])->whereNumber('id');
    Route::delete('/{id}/promotions', [CartItemController::class, 'deletePromotions'])->whereNumber('id');
});

Route::prefix('promotion')->group(function () {
    Route::get('/', [PromotionController::class, 'showAll']);
    Route::get('/{id}', [PromotionController::class, 'show'])->whereNumber('id');

    Route::get('/cart-item/{cartItemId}', [PromotionController::class, 'getPromotionsForCartItem'])->whereNumber('cartItemId');
    Route::post('/cart-item/{cartItemId}/create', [PromotionController::class, 'create'])->whereNumber('cartItemId');
    Route::post('/{id}/update', [PromotionController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [PromotionController::class, 'delete'])->whereNumber('id');
});

Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'showAll']);
    Route::get('/{id}', [OrderController::class, 'show'])->whereNumber('id');

    Route::get('/cart/{cartId}', [OrderController::class, 'showCartForCreateOrder'])->whereNumber('cartIdd');

    Route::post('cart/{cartId}/create', [OrderController::class, 'create'])->whereNumber('cartId');
    Route::post('/{id}/update', [OrderController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [OrderController::class, 'delete'])->whereNumber('id');
});

Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'showAll']);
    Route::get('/{id}', [CustomerController::class, 'show'])->whereNumber('id');

    Route::post('/create', [CustomerController::class, 'create']);
    Route::post('/{id}/update', [CustomerController::class, 'update'])->whereNumber('id');

    Route::delete('/{id}', [CustomerController::class, 'delete'])->whereNumber('id');
});
