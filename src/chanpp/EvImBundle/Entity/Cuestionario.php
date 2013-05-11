<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cuestionario
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cuestionario
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
     * @ORM\ManyToMany(targetEntity="PreguntaAlternativa", mappedBy="cuestionarios")
     */
    protected $preguntasalternativa;


    public function __construct()
    {
        $this->preguntasalternativa = new ArrayCollection();
        #$this->preguntasdesarrollo = new ArrayCollection();
    }

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
     * @return Cuestionario
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
     * Add preguntasalternativa
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa
     * @return Cuestionario
     */
    public function addPreguntasalternativa(\chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa)
    {
        $this->preguntasalternativa[] = $preguntasalternativa;
    
        return $this;
    }

    /**
     * Remove preguntasalternativa
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa
     */
    public function removePreguntasalternativa(\chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa)
    {
        $this->preguntasalternativa->removeElement($preguntasalternativa);
    }

    /**
     * Get preguntasalternativa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntasalternativa()
    {
        return $this->preguntasalternativa;
    }
}