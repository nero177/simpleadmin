<?php

namespace App\Classes;

use App\Classes\TemplatesManager;

class Page{
    public static function part($name){
        require_once 'views/components/' . $name . '.php';
    }

    public static function template_part($name){
        require_once TemplatesManager::$selected_template . '/parts/' . $name . '.php';
    }

    public static function createPage(){
        $title = $_POST['title'];
        $url = "/" . $_POST['url'];
        $template_file = $_POST['template_file'];

        $sql = "INSERT pages (title, url, template_file) VALUES (?,?,?)";
        $query = App::exec($sql, [$title, $url, $template_file]);

        header('Location: ' . App::$API_URL . '/admin/pages');
    }

    public static function deletePage(){
        $id = $_POST['id'];

        $sql = "DELETE FROM pages WHERE id=?";
        $query = App::exec($sql, [$id]);    

        header('Location: ' . App::$API_URL . '/admin/pages');
    }

    public static function changePageFile(){
        $page_title = $_POST['page_title'];
        $template_file = $_POST['template_file'];

        $sql = "UPDATE `pages` SET `template_file`='$template_file' WHERE `title`='$page_title'";
        $query = App::exec($sql);
        
        header('Location: ' . App::$API_URL . '/admin/pages');
    }

    public static function getTemplatePages(){
        $sql = "SELECT * FROM pages";
        $query = App::exec($sql);
        return $query;
    }
}