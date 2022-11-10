<?php

namespace App\Classes;

class TemplatesManager{
    public static string $selected_template;

    public static function uploadTemplate(){
        $tempdir = $_FILES['templateArchive']['tmp_name'];
        $filename = $_FILES['templateArchive']['name'];

        $newdir = substr($filename, 0, strpos($filename, ".zip"));
        //unzip archive and move its files to uploaded_templates
        $zip = new \ZipArchive();

        if($zip->open($tempdir) !== true){
            throw new Exception('Cannot open the zip file');
        }

        $template_path = 'uploaded_templates/' . $newdir;
        $zip->extractTo($template_path);

        if(file_exists($template_path . '/' . $newdir)){
            FilesUtils::recursive_rmdir($template_path . '/' . $newdir);
            $zip->extractTo('uploaded_templates/');
        }

        //validate template (check if tempate_info.json exists)
        if(!file_exists($template_path . '/template_info.json')){
            FilesUtils::recursive_rmdir($template_path);
        } 

        header('Location: ' . App::$API_URL . '/admin/page_templates');
    }

    public static function loadTemplates(){
        $templates = scandir('./uploaded_templates', 1);
        $templates = array_diff($templates, ['.', '..']);
        $templates_arr = [];

        foreach($templates as $template){        
            $templates_arr[] = $template;
        }
        
        return $templates_arr;
    }

    public static function deleteTemplate(){
        $template_name = $_POST['template_name'];  
        $template_path = 'uploaded_templates/' . $template_name;

        if(!file_exists($template_path))
            return;

        FilesUtils::recursive_rmdir($template_path);

        header('Location: ' . App::$API_URL . '/admin/page_templates');
    }

    public static function selectTemplate(){
        $template_path = 'uploaded_templates/' . $_POST['template_name']; 
        $sql = "UPDATE settings SET selected_template = ?";

        App::exec($sql, [$template_path]);
     
        header('Location: ' . App::$API_URL . '/admin/page_templates');
    }

    public static function getTemplatePages($template_path){
        $template_dir = scandir($template_path, 1);
        $template_dir = array_diff($template_dir, ['.', '..']);
        $template_pages = [];

        foreach($template_dir as $file){            
            if($file === 'pages'){
                $pages_dir_path = $template_path . '/' . $file;
                $pages_dir = scandir($pages_dir_path);
                $pages_dir = array_diff($pages_dir, ['.', '..']);

                foreach($pages_dir as $page){
                    $template_pages[] = [
                        "path" => $pages_dir_path . '/' . $page,
                        "name" => $page
                    ];
                }
            }
        }
       
        return $template_pages;
    }
}