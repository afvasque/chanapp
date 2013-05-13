<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * RespuestaDesarrollo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RespuestaDesarrollo
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
     * @ORM\Column(name="respuesta", type="text")
     */
    private $respuesta;

     /**
     * @ORM\ManyToOne(targetEntity="Respuesta")
     * @ORM\JoinColumn(name="respuesta_id", referencedColumnName="id",onDelete="CASCADE")
     */
    protected $respuesta_parent;

    /**
     * @ORM\ManyToOne(targetEntity="PreguntaDesarrollo")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id",onDelete="CASCADE")
     */
    protected $pregunta;

    public function __construct()
    {
        $this->respuesta_parent = new ArrayCollection();
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
     * Set respuesta
     *
     * @param string $respuesta
     * @return RespuestaDesarrollo
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    
        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set respuesta_parent
     *
     * @param \chanpp\EvImBundle\Entity\Respuesta $respuestaParent
     * @return RespuestaDesarrollo
     */
    public function setRespuestaParent(\chanpp\EvImBundle\Entity\Respuesta $respuestaParent = null)
    {
        $this->respuesta_parent = $respuestaParent;
    
        return $this;
    }

    /**
     * Get respuesta_parent
     *
     * @return \chanpp\EvImBundle\Entity\Respuesta 
     */
    public function getRespuestaParent()
    {
        return $this->respuesta_parent;
    }

    /**
     * Set pregunta
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaDesarrollo $pregunta
     * @return RespuestaDesarrollo
     */
    public function setPregunta(\chanpp\EvImBundle\Entity\PreguntaDesarrollo $pregunta = null)
    {
        $this->pregunta = $pregunta;
    
        return $this;
    }

    /**
     * Get pregunta
     *
     * @return \chanpp\EvImBundle\Entity\PreguntaDesarrollo 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }
}