<?php

use AppBundle\Entity\Comision;

class ComisionTest extends \PHPUnit_Framework_TestCase
{
    public function testComisionInstantiationShouldSetTramiteType()
    {
        $tramite = new Comision();
        $this->assertEquals('comision', $tramite->getType());
    }
}
