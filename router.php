<?php
/**
 * Created by Vokuro-Cli
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

$router->add('/blog/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'blog',
    'action'     => 'delete',
    'id'         => 1
));

/**  Category $router */
$router->add('/category', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'category',
    'action'     => 'index'
));

$router->add('/category/list', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'category',
    'action'     => 'list'
));

$router->add('/category/create', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'category',
    'action'     => 'create'
));

$router->add('/category/edit', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'category',
    'action'     => 'edit'
));

$router->add('/category/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'category',
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

$router->add('/page/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'page',
    'action'     => 'delete',
    'id'         => 1
));

/**  Page Category $router */
$router->add('/pagecat', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'pagecat',
    'action'     => 'index'
));

$router->add('/pagecat/list', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'pagecat',
    'action'     => 'list'
));

$router->add('/pagecat/create', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'pagecat',
    'action'     => 'create'
));

$router->add('/pagecat/edit', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'pagecat',
    'action'     => 'edit'
));

$router->add('/pagecat/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Cms\Controllers',
    'module'     => 'cms',
    'controller' => 'pagecat',
    'action'     => 'delete',
    'id'         => 1
));