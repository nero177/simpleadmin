<?php

use App\Classes\Router;
use App\Classes\Page;

$pages = Page::getTemplatePages()->fetchAll();

foreach ($pages as $page){
    Router::template_page($page['template_file'], $page['url']);
}

