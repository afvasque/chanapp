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
     * @ORM\OneToOne(targetEntity="Evaluacion", inversedBy="evaluaciondirecta")
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

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {   
        //Check the unit and convert accordingly
        $resultado = $this->resultado;
        $unidad = $this->unidad;
        if($unidad == 1) //Fuel Oil
        {
            $resultado = $resultado * 12210.99;
        }
        else if($unidad == 2) //Diesel
        {
           $resultado = $resultado * 10647.99; 
        }
        else if($unidad == 3) //Gas Licuado - Liquido
        {
           $resultado = $resultado * 7739.45; 
        }
        else if($unidad == 4) //Gas Licuado - Gaseoso
        {
           $resultado = $resultado * 9720.00; 
        }
        else if($unidad == 5)//Gas Natural
        {
           $resultado = $resultado * 10.86; 
        }
        else if($unidad == 6) //Carbón
        {
           $resultado = $resultado * 8140.66; 
        }
        else if($unidad == 7)
        {
           $resultado = $resultado * 10456.10; 
        }
        else{
            //Nothing, the rest is already in kWh
        }
        //From kWh to mWh
        $resultado = $resultado/1000;
        return $resultado;
    }
}