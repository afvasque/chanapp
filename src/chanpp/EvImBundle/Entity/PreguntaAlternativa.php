<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PreguntaAlternativa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PreguntaAlternativa
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
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

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
     * @var array
     *
     * @ORM\Column(name="alternativas", type="array")
     */
    private $alternativas;

    /**
     * @ORM\ManyToMany(targetEntity="Cuestionario")
     * @ORM\JoinColumn(name="cuestionario_id", referencedColumnName="id")
     */
    protected $cuestionarios;

     public function __construct()
    {
        $this->cuestionarios = new ArrayCollection();
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
     * @return PreguntaAlternativa
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
     * Set tipo
     *
     * @param integer $tipo
     * @return PreguntaAlternativa
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
     * Set eje
     *
     * @param integer $eje
     * @return PreguntaAlternativa
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
     * @return PreguntaAlternativa
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
     * Set alternativas
     *
     * @param array $alternativas
     * @return PreguntaAlternativa
     */
    public function setAlternativas($alternativas)
    {
        $this->alternativas = $alternativas;
    
        return $this;
    }

    /**
     * Get alternativas
     *
     * @return array 
     */
    public function getAlternativas()
    {
        return $this->alternativas;
    }

    /**
     * Add cuestionarios
     *
     * @param \chanpp\EvImBundle\Entity\Cuestionario $cuestionarios
     * @return PreguntaAlternativa
     */
    public function addCuestionario(\chanpp\EvImBundle\Entity\Cuestionario $cuestionarios)
    {
        $this->cuestionarios[] = $cuestionarios;
    
        return $this;
    }

    /**
     * Remove cuestionarios
     *
     * @param \chanpp\EvImBundle\Entity\Cuestionario $cuestionarios
     */
    public function removeCuestionario(\chanpp\EvImBundle\Entity\Cuestionario $cuestionarios)
    {
        $this->cuestionarios->removeElement($cuestionarios);
    }

    /**
     * Get cuestionarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuestionarios()
    {
        return $this->cuestionarios;
    }
}