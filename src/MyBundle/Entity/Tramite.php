<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use MyBundle\Entity\Document;
use AppBundle\Entity\Comision;

/**
 * Tramite
 * @ORM\Table(name="tramite")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\TramiteRepository")
 */
class Tramite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var array
     * @Assert\Count(
     *      min = "1",
     *      max = "10",
     *      minMessage = "Debe tener al menos 1 Archivo, en caso de ser el tomo completo",
     *      maxMessage = "Sólo puede tener como maximo {{ limit }} Archivos"
     * )
     * @ORM\OneToMany(targetEntity="Document", mappedBy="tramite", cascade={"persist", "remove"}, orphanRemoval=true) 
     * @Assert\Valid
     */
    protected $recaudos;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Comision", mappedBy="tramite")
     */
    //protected $comision;

    public function __construct()
    {
        $this->recaudos = new ArrayCollection(array(new Document("Recaudo_1")
            ,new Document("Recaudo_2"),new Document("Recaudo_3"),
            new Document("Recaudo_4"),new Document("Recaudoo_5")
            ));
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get recaudos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecaudos()
    {
        return $this->recaudos;
    }
    /**
     * Add recaudo
     *
     * @param \MyBundle\Entity\Document $recaudo
     * @return tramite
     */
    public function addRecaudo(\MyBundle\Entity\Document $recaudo)
    {
        $this->recaudos[] = $recaudo;
        $recaudo->setTramite($this);
        
        return $this;
    }
    /**
     * Remove recaudo
     *
     * @param \MyBundle\Entity\Document $recaudo
     */
    public function removeRecaudo(\MyBundle\Entity\Document $recaudo)
    {
        $this->recaudos->removeElement($recaudo);
        $recaudo->setTramite(null);
    }
    /**
     * Remove recaudos
     *
     */
    public function removeAllRecaudos()
    {
        $this->recaudos->clear();
    }

    /**
     * Get comision
     *
     * @return \AppBundle\Entity\Comision
     */
    public function getComision()
    {
        return $this->comision;
    }

    public function __toString() {
        return sprintf($this->getId());
    }
}