<?php

namespace App\Classes;
use App\Classes\TemplateManager;

class Router{
    private static $list = []; //admin routes

    public static function get($page, $uri){
        self::$list[] = [
            "page" => $page,
            "uri" => $uri
        ];
    }

    public static function post($page, $uri, $class, $method){
        self::$list[] = [
            "page" => $page,
            "uri" => $uri,
            "class" => $class,
            "method" => $method
        ];
    }

    public static function start(){
        $q = '';

        if(isset($_GET['q']))
            $q = $_GET['q']; //query string

        foreach(self::$list as $item){
            if($item['uri'] === '/' . $q){
                if(isset($item['class'])){ //is post query
                    $method = $item['method'];
                    $class = new $item['class'];

                    $class->$method();
                    return;
                }

                if(isset($item['template_file'])){ //if template page
                    require_once TemplatesManager::$selected_template . '/pages/' . $item['template_file'];
                    return;
                }

                require_once 'views/pages/' . $item['page'] . '.php';
                return;
            } 
        }

        require_once 'views/pages/404.php';
    }

    public static function template_page($template_file, $uri){
        self::$list[] = [
            "uri" => $uri,
            "template_file" => $template_file
        ];
    }
}

