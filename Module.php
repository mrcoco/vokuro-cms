<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 10/6/2016
 * Time: 9:06 PM
 */

namespace Modules\Pages;
use Phalcon\Loader;

class Module extends \Extend\ModulesAbstract
{
    protected $controller_namespace = 'Modules\\Pages\\Controllers';
    protected $module_full_path = __DIR__;

    public function registerAutoloaders(\Phalcon\DiInterface $di = null) // <- here it is)
    {

        $loader = new Loader();

        $config = include APP_DIR . '/config/config.php';

        $loader->registerNamespaces(
            array(
                $this->controller_namespace => __DIR__ . '/controllers/',
                'Modules\\Pages\\Models' => __DIR__ . '/models/',
                'Modules\\Pages\\Forms'  => __DIR__ . '/forms',
                'Modules\\Pages\\Plugin'    => __DIR__ . '/plugin',
                // Just in case : External Modules need to be in the namespace
                'Core\\Controllers'         => APP_DIR . '/controllers/',
            )
        );

        $loader->register();
    } /* registerAutoloaders */
}