<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    CategoryController,
    ProductController,
    OrderController
};

Route::prefix('admin')->middleware('auth')->group(function(){
    // Route::get('/dashboard',[DashboardController::class,'index']);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', OrderController::class)->only(['index','show','update']);
});
