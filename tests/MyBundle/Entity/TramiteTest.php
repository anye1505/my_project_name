<?php

use MyBundle\Entity\Tramite;

class TramiteTest extends \PHPUnit_Framework_TestCase
{
    public function testTramiteInstantiationShouldSetTramiteType()
    {
        $tramite = new Tramite();
        $this->assertEquals('tramite', $tramite->getType());
    }
}
