<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use MyBundle\Entity\Tramite;
use MyBundle\Entity\Document;

/**
 * Comision
 *
 * @ORM\Table(name="comision")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComisionRepository")
 */
class Comision extends Tramite
{
    protected $type="comision";

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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

    public function __construct()
    {
        $documents = array(new Document(), new Document(), new Document(), new Document());

        $this->recaudos = new ArrayCollection($documents);
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

    public function __toString() {
        return sprintf($this->getId());
    }
}
