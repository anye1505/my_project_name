<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MyBundle\Entity\Tramite;
use MyBundle\Entity\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use MyBundle\Entity\Tramite as BaseTramite;

/**
 * Comision
 *
 * @ORM\Table(name="comision")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComisionRepository")
 */
class Comision extends BaseTramite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="MyBundle\Entity\Tramite", mappedBy="comision", cascade={"persist", "remove"}, orphanRemoval=true) 
     * @ORM\JoinColumn(name="tramite_id", referencedColumnName="id")
     */
    protected $tramite;

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
     * Set tramite
     *
     * @param \MyBundle\Entity\Tramite $tramite
     * @return Comision
     */
    public function setTramite(\MyBundle\Entity\Tramite $tramite = null)
    {
        $this->tramite = $tramite;
        return $this;
    }
    /**
     * Get tramite
     *
     * @return \MyBundle\Entity\Tramite
     */
    public function getTramite()
    {
        return $this->tramite;
    }

    public function __toString() {
        return sprintf($this->getId());
    }
}

