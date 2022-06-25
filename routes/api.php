<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CancellationController;
use App\Http\Controllers\API\SizeController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\FeedbackController;
use App\Http\Controllers\API\PhoneController;
use App\Http\Controllers\API\ShipperController;
use App\Http\Controllers\API\UserCustomerController;
use App\Http\Controllers\API\UserSupplierController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


// Authentication Routes
Route::controller(AuthController::class)->group(function() {
    Route::post('user/register', 'register');
    Route::post('user/login', 'login');
    Route::post('user/logout', 'logout');
    Route::post('user/refresh', 'refresh');
    Route::get('user', 'getAuthUser');
});

Route::middleware(['jwt.verify'])->group(function () {
    
    // The Different API Controllers Route Resources (CRUD Controllers)
    Route::apiResources([
        'products' => ProductController::class,
        'feedbacks' => FeedbackController::class,
        'categories' => CategoryController::class,
        'colors' => ColorController::class,
        'sizes' => SizeController::class,
        'orders' => OrderController::class,
        'users' => UserController::class,
        'suppliers' => UserSupplierController::class,
        'customers' => UserCustomerController::class,
        'shippers' => ShipperController::class,
        'cancellations' => CancellationController::class,
        'coupons' => CouponController::class,
        'phones' => PhoneController::class,
    ]);
});


// Many-To-Many Insertion Routes
Route::post('product/orders', [ProductController::class, 'attachOrders']);
Route::post('product/colors', [ProductController::class, 'attachColors']);
Route::post('product/sizes', [ProductController::class, 'attachSizes']);
Route::post('color/products', [ColorController::class, 'attachProducts']);
Route::post('size/products', [SizeController::class, 'attachProducts']);
Route::post('order/products', [OrderController::class, 'attachProducts']);

// Polymorphic Retrieval Routes
Route::get('shipper/phones/{shipper}', [ShipperController::class, 'retrievePhones']);
Route::get('supplier/phones/{id}', [UserSupplierController::class, 'retrievePhones']);

// Polymorphic Insertion Routes
Route::post('phone/shipper/{shipper}', [PhoneController::class, 'appendPhonesToShipper']);
Route::post('phone/supplier/{id}', [PhoneController::class, 'appendPhonesToSupplier']);