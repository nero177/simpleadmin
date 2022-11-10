<?php
use App\Classes\Router;
use App\Classes\TemplatesManager;
use App\Classes\Page;

Router::get('admin', '/admin');

/*TEMPLATES*/ 
Router::get('page_templates', '/admin/page_templates');
Router::post('uploadTemplate', '/admin/uploadTemplate', TemplatesManager::class, 'uploadTemplate');
Router::post('deleteTemplate', '/admin/deleteTemplate', TemplatesManager::class, 'deleteTemplate');
Router::post('selectTemplate', '/admin/selectTemplate', TemplatesManager::class, 'selectTemplate');

/*PAGES*/
Router::get('pages', '/admin/pages');
Router::post('createPage', '/admin/createPage', Page::class, 'createPage');
Router::post('deletePage', '/admin/deletePage', Page::class, 'deletePage');
Router::post('changePageFile', '/admin/changePageFile', Page::class, 'changePageFile');

