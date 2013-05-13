<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * PreguntaDesarrollo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PreguntaDesarrollo
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
     * @ORM\Column(name="enunciado", type="text")
     */
    private $enunciado;

    /**
     * @var integer
     *
     * @ORM\Column(name="eje", type="integer")
     */
    private $eje;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeropregunta", type="integer")
     */
    private $numeropregunta;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Cuestionario")
     * @ORM\JoinColumn(name="cuestionario_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $cuestionario;

    /**
     * @ORM\OneToMany(targetEntity="RespuestaAlternativa", mappedBy="pregunta")
     */
    protected $respuestas;

    /**
     * @ORM\OneToMany(targetEntity="PreguntaDesarrollo", mappedBy="preguntapadre")
     */
    protected $preguntashijas;

    /**
     * @ORM\ManyToOne(targetEntity="PreguntaDesarrollo")
     * @ORM\JoinColumn(name="preguntapadre_id", referencedColumnName="id",onDelete="CASCADE")
     */
    protected $preguntapadre;
    
     public function __construct()
    {
        $this->respuestas = new ArrayCollection();
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
     * Set enunciado
     *
     * @param string $enunciado
     * @return PreguntaDesarrollo
     */
    public function setEnunciado($enunciado)
    {
        $this->enunciado = $enunciado;
    
        return $this;
    }

    /**
     * Get enunciado
     *
     * @return string 
     */
    public function getEnunciado()
    {
        return $this->enunciado;
    }

    /**
     * Set eje
     *
     * @param integer $eje
     * @return PreguntaDesarrollo
     */
    public function setEje($eje)
    {
        $this->eje = $eje;
    
        return $this;
    }

    /**
     * Get eje
     *
     * @return integer 
     */
    public function getEje()
    {
        return $this->eje;
    }

    /**
     * Set numeropregunta
     *
     * @param integer $numeropregunta
     * @return PreguntaDesarrollo
     */
    public function setNumeropregunta($numeropregunta)
    {
        $this->numeropregunta = $numeropregunta;
    
        return $this;
    }

    /**
     * Get numeropregunta
     *
     * @return integer 
     */
    public function getNumeropregunta()
    {
        return $this->numeropregunta;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return PreguntaDesarrollo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set cuestionario
     *
     * @param \chanpp\EvImBundle\Entity\Cuestionario $cuestionario
     * @return PreguntaDesarrollo
     */
    public function setCuestionario(\chanpp\EvImBundle\Entity\Cuestionario $cuestionario = null)
    {
        $this->cuestionario = $cuestionario;
    
        return $this;
    }

    /**
     * Get cuestionario
     *
     * @return \chanpp\EvImBundle\Entity\Cuestionario 
     */
    public function getCuestionario()
    {
        return $this->cuestionario;
    }

    /**
     * Add respuestas
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas
     * @return PreguntaDesarrollo
     */
    public function addRespuesta(\chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas)
    {
        $this->respuestas[] = $respuestas;
    
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas
     */
    public function removeRespuesta(\chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas)
    {
        $this->respuestas->removeElement($respuestas);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Add preguntashijas
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntashijas
     * @return PreguntaDesarrollo
     */
    public function addPreguntashija(\chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntashijas)
    {
        $this->preguntashijas[] = $preguntashijas;
    
        return $this;
    }

    /**
     * Remove preguntashijas
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntashijas
     */
    public function removePreguntashija(\chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntashijas)
    {
        $this->preguntashijas->removeElement($preguntashijas);
    }

    /**
     * Get preguntashijas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntashijas()
    {
        return $this->preguntashijas;
    }

    /**
     * Set preguntapadre
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntapadre
     * @return PreguntaDesarrollo
     */
    public function setPreguntapadre(\chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntapadre = null)
    {
        $this->preguntapadre = $preguntapadre;
    
        return $this;
    }

    /**
     * Get preguntapadre
     *
     * @return \chanpp\EvImBundle\Entity\PreguntaDesarrollo 
     */
    public function getPreguntapadre()
    {
        return $this->preguntapadre;
    }
}