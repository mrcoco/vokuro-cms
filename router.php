<?php
/**
 * Created by Phalms-Cli
 * User: dwiagus
 * Date: 10/01/2017
 * Time: 0909:0101:2727
 */

$router->add('/blog', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'blog',
    'action'     => 'index'
));

$router->add('/blog/list', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'blog',
    'action'     => 'list'
));

$router->add('/blog/create', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'blog',
    'action'     => 'create'
));

$router->add('/blog/edit', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'blog',
    'action'     => 'edit'
));

$router->add('/blog/get', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'blog',
    'action'     => 'get'
));

$router->add('/blog/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'blog',
    'action'     => 'delete',
    'id'         => 1
));

/**  Category $router */
$router->add('/blog/category', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'Blog_Category',
    'action'     => 'index'
));

/**  Category $router */
$router->add('/blog/categories', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'Blog_Category',
    'action'     => 'all'
));

$router->add('/blog/category/list', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'Blog_Category',
    'action'     => 'list'
));

$router->add('/blog/category/create', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'Blog_Category',
    'action'     => 'create'
));

$router->add('/blog/category/edit', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'Blog_Category',
    'action'     => 'edit'
));

$router->add('/blog/category/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'Blog_Category',
    'action'     => 'delete',
    'id'         => 1
));

/**  Page $router */
$router->add('/page', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page',
    'action'     => 'index'
));

$router->add('/page/list', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page',
    'action'     => 'list'
));

$router->add('/page/create', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page',
    'action'     => 'create'
));

$router->add('/page/edit', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page',
    'action'     => 'edit'
));

$router->add('/page/get', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page',
    'action'     => 'get'
));

$router->add('/page/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page',
    'action'     => 'delete',
    'id'         => 1
));

/**  Page Category $router */
$router->add('/page/category', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page_category',
    'action'     => 'index'
));

$router->add('/page/categories', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page_category',
    'action'     => 'all'
));

$router->add('/page/category/list', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page_category',
    'action'     => 'list'
));

$router->add('/page/category/create', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page_category',
    'action'     => 'create'
));

$router->add('/page/category/edit', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page_category',
    'action'     => 'edit'
));

$router->add('/page/category/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page_category',
    'action'     => 'delete',
    'id'         => 1
));