<?php

namespace App\Services;

class Tinify{

    function __construct()
    {
        \Tinify\setKey(env('TINIFY_API_TOKEN',null));
    }

    function resizeAndSave($path,$imageName){

        $source = \Tinify\fromFile(asset($path.$imageName));

        $url = "storage/photos/".$imageName;

        $resized = $source->resize(array(
            "method" => "fit",
            "width" => 200,
            "height" => 200
        ));

        $resized->toFile($url);

        return asset($url);
    }
}
