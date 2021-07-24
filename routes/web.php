<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function (){
    Route::post("login",[\App\Http\Controllers\Auth\LoginController::class,"login"]);
    Route::get("unauthorized",[\App\Http\Controllers\Auth\LoginController::class,"unauthorized"])
        ->name('unauthorized');
});

Route::middleware('auth:api')->group(function (){
    Route::post("upload",function (Request $request){
        if($request->hasFile("image")){
            $image = \Illuminate\Support\Facades\Storage::disk("images")->put("",$request->file("image"));
            return response()->json($image);
        }else{
            return response()->json(false,422);
        }
    });
    Route::prefix('admin')->middleware('admin')->group(function (){
        Route::resource("company",\App\Http\Controllers\Admin\AdminCompanyController::class);
        Route::resource("hall",\App\Http\Controllers\Admin\AdminHallController::class);
        Route::resource("filter_group",\App\Http\Controllers\Admin\AdminFilterGroupController::class);
        Route::resource("filter",\App\Http\Controllers\Admin\AdminFilterController::class);
        Route::resource("hall_filter",\App\Http\Controllers\Admin\AdminHallFilterController::class);
        Route::resource("calendar",\App\Http\Controllers\Admin\AdminCalendarController::class);
        Route::resource("calendar_day",\App\Http\Controllers\Admin\AdminCalendarDayController::class);
    });
});
