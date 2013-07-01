<?php

namespace ZendSkeletonModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * Default action if none provided.
     *
     * @return array
     */
    public function indexAction()
    {
        return new ViewModel;
    }

    /**
     * This shows the :controller and :action parameters in default route
     * are working when you browse to /module-specific-root/skeleton/foo.
     *
     * @return array
     */
    public function fooAction()
    {
        return [];
    }
}