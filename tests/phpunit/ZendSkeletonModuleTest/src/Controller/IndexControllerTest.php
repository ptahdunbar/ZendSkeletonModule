<?php

namespace ZendSkeletonModuleTest\Controller;

use Tests\Bootstrap;
use ZendSkeletonModule\Controller\IndexController;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * IndexControllerTest
 *
 * @package ZendSkeletonModuleTest\Controller
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * Object under test.
     *
     * @var \ZendSkeletonModule\Controller\IndexController $controller
     */
    protected $controller;

    /**
     * This method is called before a test is executed.
     *
     * Setup the fixture, for example, open a network connection.
     */
    public function setUp()
    {
        $this->setApplicationConfig(
            Bootstrap::getConfig()
        );

        parent::setUp();

        $this->controller = new IndexController;
    }

    /**
     * Zend Framework 2 controllers must implement
     * \Zend\Stdlib\DispatchableInterface, however where extending that to
     * extending \Zend\Mvc\Controller\AbstractController as it sets up the
     * context and nessecary code.
     */
    public function testControllerIsDispatchable()
    {
        $this->assertInstanceOf('Zend\Mvc\Controller\AbstractController', $this->controller);
    }

    /**
     * The controller should be able to fire off events.
     */
    public function testControllerIsEventManagerAware()
    {
        $this->assertInstanceOf('Zend\EventManager\EventManagerAwareInterface', $this->controller);
    }

    /**
     * The controller must be able to access the service manager.
     */
    public function testControllerIsServiceManagerAware()
    {
        $this->assertInstanceOf('Zend\ServiceManager\ServiceLocatorAwareInterface', $this->controller);
    }
}