<?php
/**
 * Created by Phalms-Cli
 * User: dwiagus
 * Date: 10/01/2017
 * Time: 0909:0101:2626
 */

namespace Modules\Cms;

use Phalcon\Loader;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                "Modules\\Cms\\Controllers" => __DIR__."/controllers/",
                "Modules\\Cms\\Models"      => __DIR__."/models/",
                "Modules\\User\\Models"      => realpath(dirname(__FILE__))."/../user/models/",
                "Modules\\Frontend\\Controllers" => realpath(dirname(__FILE__))."/../frontend/controllers/",
            ]
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        // registering view
        $config = $di->get('config');
        $view = $di->get('view');
        $view->setViewsDir(__DIR__. '/views/');
        $view->setMainView('main');
        $view->setLayoutsDir($config->application->layoutsDir);
        $view->setPartialsDir($config->application->adminPartialDir );
        $view->setLayout('private');
    }
}