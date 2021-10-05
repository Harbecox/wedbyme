<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function (){
    Route::post("login",[\App\Http\Controllers\Auth\LoginController::class,"login"]);
    Route::get("unauthorized",[\App\Http\Controllers\Auth\LoginController::class,"unauthorized"])
        ->name('unauthorized');
});

Route::prefix("image")->group(function (){
    Route::get("{image}",[\App\Http\Controllers\ImageController::class,"get"]);
    Route::post("upload",[\App\Http\Controllers\ImageController::class,"upload"]);
});


Route::middleware('auth:api')->group(function (){

    Route::prefix('admin')->middleware('admin')->as("admin")->group(function (){
        Route::resource("company",\App\Http\Controllers\Admin\AdminCompanyController::class);
        Route::resource("hall",\App\Http\Controllers\Admin\AdminHallController::class);
        Route::resource("filter_group",\App\Http\Controllers\Admin\AdminFilterGroupController::class);
        Route::resource("filter",\App\Http\Controllers\Admin\AdminFilterController::class);
        Route::resource("hall_filter",\App\Http\Controllers\Admin\AdminHallFilterController::class);
        Route::resource("calendar",\App\Http\Controllers\Admin\AdminCalendarController::class);
        Route::resource("calendar_day",\App\Http\Controllers\Admin\AdminCalendarDayController::class);
        Route::resource("service",\App\Http\Controllers\Admin\AdminServiceController::class);
        Route::resource("service_filter",\App\Http\Controllers\Admin\AdminServiceFilterController::class);
    });

    Route::prefix("profile")->group(function (){
        Route::get("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"index"]);
        Route::put("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"update"]);
        Route::prefix("hall")->group(function (){
            Route::post("",[\App\Http\Controllers\Front\CompanyProfileController::class,"store_hall"]);
            Route::prefix("{id}")->group(function (){
                Route::put("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"update_hall"]);
                Route::delete("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"delete_hall"]);
                Route::put("filters",[\App\Http\Controllers\Front\CompanyProfileController::class,"store_update_filters"]);
            });
        });

    });
});

Route::prefix("halls")->group(function (){
    Route::post("/",[App\Http\Controllers\Front\HallController::class,"index"]);
    Route::get("/{seo_url}",[App\Http\Controllers\Front\HallController::class,"show"]);
});
