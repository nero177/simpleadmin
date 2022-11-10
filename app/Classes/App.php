<?php

namespace App\Classes;

use App\Classes\Router;
use App\Classes\TemplatesManager;

class App{
    public static $API_URL;
    public static $pdo;
    public static $settings;

    public static function start($cwd){
        include_once 'db.php';
        self::$pdo = $pdo;

        $sql = "SELECT * FROM settings";
        $statement = self::exec($sql);

        self::$settings = $statement->fetch();

        TemplatesManager::$selected_template = self::$settings['selected_template'];
    }

    public static function exec($sql_query, $params = NULL){ //execute sql query
        $query = self::$pdo->prepare($sql_query);
        $query->execute($params);
        return $query;
    }
}