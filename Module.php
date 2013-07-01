<?php

namespace ZendSkeletonModule;

use Zend\Mvc\ModuleRouteListener;
use Zend\EventManager\EventInterface;

use Zend\ModuleManager\Feature\BootstrapListenerInterface,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\Feature\FormElementProviderInterface
;

/**
 * Module
 *
 * @package ZendSkeletonModule
 */
class Module implements
    BootstrapListenerInterface,
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface,
    FormElementProviderInterface
{
    /**
     * @param EventInterface $e
     */
    public function onBootstrap(EventInterface $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener;
        $moduleRouteListener->attach($eventManager);
    }

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' =>
            [
                'namespaces' =>
                [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Returns configuration to merge with application configuration.
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include_once __DIR__ . '/config/module.config.php';
    }

    /**
     * Valid values:
     *
     * abstract_factories
     * - class implementing AbstractFactoryInterface
     * - instances of classes implementing AbstractFactoryInterface
     * - any php callback
     *
     * aliases
     * - a FQCN to a service name.
     * - a known service name.
     * - an alias
     *
     * factories
     * - a FQCN to a service name.
     * - a known service name.
     * - any php callback
     * - class implementing FactoryInterface
     * - instances of classes implementing FactoryInterface
     *
     * invokables
     * - a FQCN to a service name.
     * - a known service name.
     *
     * services
     * - a known service name.
     *
     * shared
     * Usually, you'll only indicate services that should **NOT** be
     * shared -- i.e., ones where you want a different instance every time.
     * - Key of a service name with a value of false.
     *      e.g. 'service' => false,
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'abstract_factories' =>
            [
//            '' => '',
            ],
            'aliases' =>
            [
//            '' => '',
            ],
            'factories' =>
            [
//            '' => '',
            ],
            'invokables' =>
            [
//            '' => '',
            ],
            'services' =>
            [
//            '' => '',
            ],
            'shared' =>
            [
//            '' => false,
            ],
        ];
    }

    /**
     * @see getServiceConfig() for return value.
     */
    public function getFormElementConfig()
    {
        return [];
    }
}