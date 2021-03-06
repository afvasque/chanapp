<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * RespuestaAlternativa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RespuestaAlternativa
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
     * @var integer
     *
     * @ORM\Column(name="respuesta", type="integer")
     */
    private $respuesta;

    /**
     * @ORM\ManyToOne(targetEntity="Respuesta")
     * @ORM\JoinColumn(name="respuesta_id", referencedColumnName="id",onDelete="CASCADE")
     */
    protected $respuesta_parent;

    /**
     * @ORM\ManyToOne(targetEntity="PreguntaAlternativa")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id", onDelete="CASCADE")
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
     * @param integer $respuesta
     * @return RespuestaAlternativa
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    
        return $this;
    }

    /**
     * Get respuesta
     *
     * @return integer 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set respuesta_parent
     *
     * @param \chanpp\EvImBundle\Entity\Respuesta $respuestaParent
     * @return RespuestaAlternativa
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
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $pregunta
     * @return RespuestaAlternativa
     */
    public function setPregunta(\chanpp\EvImBundle\Entity\PreguntaAlternativa $pregunta = null)
    {
        $this->pregunta = $pregunta;
    
        return $this;
    }

    /**
     * Get pregunta
     *
     * @return \chanpp\EvImBundle\Entity\PreguntaAlternativa 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }
}