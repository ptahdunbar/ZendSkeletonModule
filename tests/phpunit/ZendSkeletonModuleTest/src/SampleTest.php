<?php

namespace ZendSkeletonModuleTest;

class SampleTest extends TestCase
{
    public function testSample()
    {
        $this->assertInstanceOf('Zend\Di\LocatorInterface', $this->getLocator());
    }
}