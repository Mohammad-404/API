<?php

    function uploadImage($folder , $image){
        $image->store('/' ,$folder);
        $filename   =  $image->hashName();
        $path       = 'assets/'.$folder.'/'.$filename;
        return $path;
    }