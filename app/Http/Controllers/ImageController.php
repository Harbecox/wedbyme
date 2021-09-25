<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    function get($image){
        if(\Illuminate\Support\Facades\Request::has("w")){
            $w = \Illuminate\Support\Facades\Request::get("w");
            $img = Storage::disk("images")->get($w."/".$image);
        }else{
            $img = Storage::disk("images")->get($image);
        }
        return \Image::make($img)->response();
    }

    function upload(Request $request){
        if($request->hasFile("image")){
            $disk = Storage::disk("images");
            $image = $disk->put("",$request->file("image"));
            $img = Image::make(Storage::disk("images")->get($image));
            $w = $img->getWidth();
            $h = $img->getHeight();
            $nw = 512;
            $nh = ($h * $nw) / $w;
            $img->resize($nw,$nh)->save(public_path("images/512/".$image));
            $nw = 320;
            $nh = ($h * $nw) / $w;
            $img->resize($nw,$nh)->save(public_path("images/320/".$image));
            return response()->json(URL::to("image/".$image));
        }else{
            return response()->json(false,422);
        }
    }
}
