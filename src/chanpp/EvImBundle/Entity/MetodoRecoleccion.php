<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MetodoRecoleccion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MetodoRecoleccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var ArrayCollection $evaluacionesindirectas
     * @ORM\ManyToMany(targetEntity="EvaluacionIndirecta", mappedBy="metodosrecoleccion", cascade={"all"})
     */
    private $evaluacionesindirectas;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return MetodoRecoleccion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * To String
     *
     * @return string 
     */
    public function _toString()
    {
        return $this->nombre;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evaluacionesindirectas = new ArrayCollection();
    }
    
    /**
     * Add evaluacionesindirectas
     *
     * @param \chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas
     * @return MetodoRecoleccion
     */
    public function addEvaluacionesindirecta(\chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas)
    {
        $this->evaluacionesindirectas[] = $evaluacionesindirectas;
    
        return $this;
    }

    /**
     * Remove evaluacionesindirectas
     *
     * @param \chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas
     */
    public function removeEvaluacionesindirecta(\chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas)
    {
        $this->evaluacionesindirectas->removeElement($evaluacionesindirectas);
    }

    /**
     * Get evaluacionesindirectas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluacionesindirectas()
    {
        return $this->evaluacionesindirectas;
    }
}