<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\Tools\SchemaTool;

use MyBundle\Entity\Document;
use MyBundle\Entity\Tramite;
use AppBundle\Entity\Comision;

class Tramites extends WebTestCase
{
    protected $em;

    public function setUp() {
        parent::setUp();

        $kernel = static::createKernel();
        $kernel->boot();

        $this->em = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testPersistTramite()
    {
        $this->em->getConnection()->beginTransaction();

        $tramite = new Tramite();
        $this->em->persist($tramite);
        $this->em->flush($tramite);
    }

    public function testPersistComision()
    {
        $this->em->getConnection()->beginTransaction();

        $comision = new Comision();
        $comision->removeAllRecaudos();

        for ($i = 1; $i <= 4; $i++) {
            touch(__DIR__ . "/../../web/uploads/oficios/doc{$i}.pdf");
            $comision->addRecaudo(new Document("document{$i}", "/doc{$i}.pdf"));
        }

        $this->em->persist($comision);
        $this->em->flush($comision);
    }
}