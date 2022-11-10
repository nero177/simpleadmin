<?php

namespace App\Classes;

class FilesUtils{
    public static function recursive_rmdir($path){
        if(is_dir($path)){ //recursively delete directory
            $template_files = scandir($path);
            $template_files = array_diff($template_files, ['.', '..']);

            foreach($template_files as $object){
                if(is_dir($path.'/'.$object))
                    self::recursive_rmdir($path.'/'.$object);
                else {
                    unlink($path.'/'.$object);
                }
            }

            rmdir($path);
        }
    }
}