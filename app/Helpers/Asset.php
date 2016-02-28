<?php
class Asset {
    public static function version($path, $secure=null){
        $file = public_path($path);
        if(file_exists($file)){
            return asset($path, $secure) . '?' . filemtime($file);
        }else{
            throw new \Exception('The file "'.$path.'" cannot be found in the public folder');
        }
    }
}
