<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function (){
    Route::post("login",[\App\Http\Controllers\Auth\LoginController::class,"login"]);
    Route::get("unauthorized",[\App\Http\Controllers\Auth\LoginController::class,"unauthorized"])
        ->name('unauthorized');
});


Route::get("image/{image}",[\App\Http\Controllers\ImageController::class,"get"]);
Route::get("home",[\App\Http\Controllers\Front\HomeController::class,"index"]);
Route::post("search",[\App\Http\Controllers\Front\HomeController::class,"search"]);

Route::middleware('auth:api')->group(function (){

    Route::post("image/upload",[\App\Http\Controllers\ImageController::class,"upload"]);

    Route::prefix('admin')->middleware('admin')->as("admin")->group(function (){
        Route::resource("company",\App\Http\Controllers\Admin\AdminCompanyController::class);
        Route::resource("hall",\App\Http\Controllers\Admin\AdminHallController::class);
        Route::post("hall/{hall_id}/filters",[\App\Http\Controllers\Admin\AdminHallController::class,"filter_update"])->name("admin_hall_filter_update");
        Route::resource("filter_group",\App\Http\Controllers\Admin\AdminFilterGroupController::class);
        Route::resource("filter",\App\Http\Controllers\Admin\AdminFilterController::class);
        Route::resource("calendar",\App\Http\Controllers\Admin\AdminCalendarController::class);
        Route::resource("calendar_day",\App\Http\Controllers\Admin\AdminCalendarDayController::class);
        Route::resource("service",\App\Http\Controllers\Admin\AdminServiceController::class);
        Route::post("service/{service_id}/filters",[\App\Http\Controllers\Admin\AdminServiceController::class,"filter_update"])->name("admin_service_filter_update");
        Route::prefix("home")->group(function (){
            Route::get("/",[\App\Http\Controllers\Admin\AdminHomeController::class,"index"])->name("admin.home.index");
            Route::post("/",[\App\Http\Controllers\Admin\AdminHomeController::class,"update"])->name("admin.home.update");
        });
    });

    Route::prefix("profile")->group(function (){
        Route::get("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"index"]);
        Route::put("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"update"]);
        Route::prefix("hall")->group(function (){
            Route::post("",[\App\Http\Controllers\Front\CompanyProfileController::class,"store_hall"]);
            Route::prefix("{id}")->group(function (){
                Route::put("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"update_hall"]);
                Route::delete("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"delete_hall"]);
                Route::put("filters",[\App\Http\Controllers\Front\CompanyProfileController::class,"update_hall_filters"]);
            });
        });
        Route::prefix("service")->group(function (){
            Route::post("",[\App\Http\Controllers\Front\CompanyProfileController::class,"store_service"]);
            Route::prefix("{id}")->group(function (){
                Route::put("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"update_service"]);
                Route::delete("/",[\App\Http\Controllers\Front\CompanyProfileController::class,"delete_service"]);
                Route::put("filters",[\App\Http\Controllers\Front\CompanyProfileController::class,"update_service_filters"]);
            });
        });
    });
});

Route::prefix("services")->group(function (){
    Route::post("/",[App\Http\Controllers\Front\ServiceController::class,"index"]);
    Route::get("/{seo_url}",[App\Http\Controllers\Front\ServiceController::class,"show"]);
});

Route::prefix("halls")->group(function (){
    Route::post("/",[App\Http\Controllers\Front\HallController::class,"index"]);
    Route::get("/{seo_url}",[App\Http\Controllers\Front\HallController::class,"show"]);
});

Route::prefix("company")->group(function (){
    Route::get("/",[\App\Http\Controllers\Front\CompanyController::class,"index"]);
    Route::get("{seo_url}",[\App\Http\Controllers\Front\CompanyController::class,"show"]);
});
