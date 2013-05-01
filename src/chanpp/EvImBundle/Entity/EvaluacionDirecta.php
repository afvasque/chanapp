<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluacionDirecta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EvaluacionDirecta
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
     * @ORM\ManyToOne(targetEntity="Evaluacion", inversedBy="evaluaciondirecta")
     * @ORM\JoinColumn(name="evaluacion_id", referencedColumnName="id")
     */
    protected $evaluacion;
    
    /**
     * @var float
     *
     * @ORM\Column(name="resultado", type="float")
     */
    private $resultado;

    /**
     * @var integer
     *
     * @ORM\Column(name="unidad", type="integer")
     */
    private $unidad;


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
     * Set resultado
     *
     * @param float $resultado
     * @return EvaluacionDirecta
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    
        return $this;
    }

    /**
     * Get resultado
     *
     * @return float 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set unidad
     *
     * @param integer $unidad
     * @return EvaluacionDirecta
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;
    
        return $this;
    }

    /**
     * Get unidad
     *
     * @return integer 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set evaluacion
     *
     * @param \chanpp\EvImBundle\Entity\Evaluacion $evaluacion
     * @return EvaluacionDirecta
     */
    public function setEvaluacion(\chanpp\EvImBundle\Entity\Evaluacion $evaluacion = null)
    {
        $this->evaluacion = $evaluacion;
    
        return $this;
    }

    /**
     * Get evaluacion
     *
     * @return \chanpp\EvImBundle\Entity\Evaluacion 
     */
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }
}