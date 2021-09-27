<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    function get($image)
    {
        $disk = Storage::disk("images");
        if (!$disk->has($image)) {
            return $this->response(false,404);
        }
        if (\Illuminate\Support\Facades\Request::has("w")) {
            $w = \Illuminate\Support\Facades\Request::get("w");
            if (!$disk->has($w . "/" . $image)) {
                $this->resizeImage($image,$w);
            }
            $img = $disk->get($w . "/" . $image);
        } else {
            $img = $disk->get($image);
        }
        return Image::make($img)->response();
    }

    function upload(Request $request)
    {
        if ($request->hasFile("image")) {
            $disk = Storage::disk("images");
            $image = $disk->put("", $request->file("image"));
            return $this->response(URL::to("image/" . $image));
        } else {
            return $this->response(false,422);
        }
    }

    function resizeImage($image, $nw): bool
    {
        $disk = Storage::disk("images");
        $img = Image::make($disk->get($image));
        $w = $img->getWidth();
        $h = $img->getHeight();
        if (!$disk->exists($nw)) {
            $disk->createDir($nw);
        }
        $nh = ($h * $nw) / $w;
        $img->resize($nw, $nh)->save(public_path("images/" . $nw . "/" . $image));
        return true;
    }
}
