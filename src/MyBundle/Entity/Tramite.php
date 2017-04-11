<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use MyBundle\Entity\Document;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"tramite" = "Tramite", "comision" = "AppBundle\Entity\Comision"})
 */
class Tramite
{
    protected $type = "tramite";

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Document", mappedBy="tramite", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $recaudos;

    public function __construct()
    {
        $this->recaudos = new ArrayCollection();
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

    public function getType()
    {
        return $this->type;
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

    public function __toString() {
        return sprintf($this->getId());
    }
}