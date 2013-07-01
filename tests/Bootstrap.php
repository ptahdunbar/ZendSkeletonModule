<?php

namespace Tests;

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Bootstrap
 *
 * Configures the service manager based on the configuration defined in
 * config/application.config.php.
 *
 * @package Tests
 */
class Bootstrap
{
    /**
     * @var \Zend\ServiceManager\ServiceManager $serviceManager
     */
    protected static $serviceManager;

    /**
     * Returns an array based on the configuration files loaded.
     *
     * @var array $config
     */
    protected static $config;

    /**
     * PHPUnit invokes this method when you run `phpunit`.
     *
     * @return void
     */
    public static function init()
    {
        define( 'APP_ENV', 'testing' );

        // Load application.config.php.
        $testConfig = include realpath(__DIR__ . '/../config/module.config.php');

        $zf2ModulePaths = [];

        if ( isset($testConfig['module_listener_options']['module_paths']) ) {
            $modulePaths = $testConfig['module_listener_options']['module_paths'];
            foreach ( $modulePaths as $modulePath ) {
                if (($path = static::findParentPath($modulePath)) ) {
                    $zf2ModulePaths[] = $path;
                }
            }
        }

        $zf2ModulePaths  = implode(PATH_SEPARATOR, $zf2ModulePaths) . PATH_SEPARATOR;
        $zf2ModulePaths .= getenv('ZF2_MODULES_TEST_PATHS') ?: (defined('ZF2_MODULES_TEST_PATHS') ? ZF2_MODULES_TEST_PATHS : '');

        static::initAutoloader();

        // use ModuleManager to load this module and it's dependencies
        $baseConfig = [
            'module_listener_options' => [
                'module_paths' => explode(PATH_SEPARATOR, $zf2ModulePaths)
            ],
        ];

        $config = ArrayUtils::merge($baseConfig, $testConfig);

        $smConfig = isset($config['service_manager']) ? $config['service_manager'] : array();
        $serviceManager = new ServiceManager(new ServiceManagerConfig($smConfig));
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        static::$serviceManager = $serviceManager;
        static::$config = $config;
    }

    /**
     * @return ServiceManager
     */
    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    /**
     * @return array
     */
    public static function getConfig()
    {
        return static::$config;
    }

    /**
     * Invokes the autoloaders.
     *
     * @return void
     */
    protected static function initAutoloader()
    {
        static::initComposerAutoloader();
        static::initZendAutoloader();
    }

    /**
     * Uses composer to configure the autoloading.
     *
     * @return void
     */
    protected static function initComposerAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        // Try to include the Composer autoloader
        if ( is_readable($vendorPath . '/autoload.php') ) {
            $loader = require $vendorPath . '/autoload.php';
            $loader->add('ZendSkeletonModuleTest\\', 'phpunit/');
        } else {
            die ('Could not find path to composer autoload.php.');
        }
    }

    /**
     * Uses the standard Zend\Loader\StandardAutoloader class to configure
     * the autoloading.
     *
     * @return void
     */
    protected static function initZendAutoloader()
    {
        AutoloaderFactory::factory([
            'Zend\Loader\StandardAutoloader' =>
            [
                'autoregister_zf' => true,
                'namespaces' =>
                [
                    'ApplicationTest'           => __DIR__ . '../module/Application/tests/phpunit/ApplicationTest/src',
                    'ZendSkeletonModuleTest'    => __DIR__ . '../module/ZendSkeletonModule/tests/phpunit/ZendSkeletonModuleTest/src',
                ]
            ]
        ]);
    }

    /**
     * Helper method to crawl up the file system tree to locate directories.
     *
     * @param string $path
     *
     * @return bool|string
     */
    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while ( ! is_dir($dir . '/' . $path) ) {
            $dir = dirname($dir);
            if ($previousDir === $dir) return false;
            $previousDir = $dir;
        }

        return $dir . '/' . $path;
    }
}

Bootstrap::init();