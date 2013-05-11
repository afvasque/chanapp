<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
