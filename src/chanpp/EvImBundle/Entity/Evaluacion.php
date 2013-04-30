<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Evaluacion
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
     * @ORM\OneToOne(targetEntity="EvaluacionDirecta", mappedBy="evaluacion")
     */
    protected $evaluaciondirecta;

    /**
     * @var string
     *
     * @ORM\Column(name="alcance", type="text")
     */
    private $alcance;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer")
     */
    private $duracion;

    /**
     * @var string
     *
     * @ORM\Column(name="confiabilidad", type="text")
     */
    private $confiabilidad;


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
     * Set alcance
     *
     * @param string $alcance
     * @return Evaluacion
     */
    public function setAlcance($alcance)
    {
        $this->alcance = $alcance;
    
        return $this;
    }

    /**
     * Get alcance
     *
     * @return string 
     */
    public function getAlcance()
    {
        return $this->alcance;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     * @return Evaluacion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    
        return $this;
    }

    /**
     * Get duracion
     *
     * @return integer 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set confiabilidad
     *
     * @param string $confiabilidad
     * @return Evaluacion
     */
    public function setConfiabilidad($confiabilidad)
    {
        $this->confiabilidad = $confiabilidad;
    
        return $this;
    }

    /**
     * Get confiabilidad
     *
     * @return string 
     */
    public function getConfiabilidad()
    {
        return $this->confiabilidad;
    }

    /**
     * Set evaluaciondirecta
     *
     * @param \chanpp\EvImBundle\Entity\EvaluacionDirecta $evaluaciondirecta
     * @return Evaluacion
     */
    public function setEvaluaciondirecta(\chanpp\EvImBundle\Entity\EvaluacionDirecta $evaluaciondirecta = null)
    {
        $this->evaluaciondirecta = $evaluaciondirecta;
    
        return $this;
    }

    /**
     * Get evaluaciondirecta
     *
     * @return \chanpp\EvImBundle\Entity\EvaluacionDirecta 
     */
    public function getEvaluaciondirecta()
    {
        return $this->evaluaciondirecta;
    }
}