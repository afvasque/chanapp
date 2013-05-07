<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvaluacionIndirecta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EvaluacionIndirecta
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
     * @ORM\Column(name="ambito", type="integer")
     */
    private $ambito;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo_interes", type="text")
     */
    private $grupoInteres;

    /**
     * @var array
     *
     * @ORM\Column(name="ejes", type="array")
     */
    private $ejes;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="plazo", type="string", length=255)
     */
    private $plazo;


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
     * Set ambito
     *
     * @param integer $ambito
     * @return EvaluacionIndirecta
     */
    public function setAmbito($ambito)
    {
        $this->ambito = $ambito;
    
        return $this;
    }

    /**
     * Get ambito
     *
     * @return integer 
     */
    public function getAmbito()
    {
        return $this->ambito;
    }

    /**
     * Set grupoInteres
     *
     * @param string $grupoInteres
     * @return EvaluacionIndirecta
     */
    public function setGrupoInteres($grupoInteres)
    {
        $this->grupoInteres = $grupoInteres;
    
        return $this;
    }

    /**
     * Get grupoInteres
     *
     * @return string 
     */
    public function getGrupoInteres()
    {
        return $this->grupoInteres;
    }

    /**
     * Set ejes
     *
     * @param array $ejes
     * @return EvaluacionIndirecta
     */
    public function setEjes($ejes)
    {
        $this->ejes = $ejes;
    
        return $this;
    }

    /**
     * Get ejes
     *
     * @return array 
     */
    public function getEjes()
    {
        return $this->ejes;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     * @return EvaluacionIndirecta
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return string 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set plazo
     *
     * @param string $plazo
     * @return EvaluacionIndirecta
     */
    public function setPlazo($plazo)
    {
        $this->plazo = $plazo;
    
        return $this;
    }

    /**
     * Get plazo
     *
     * @return string 
     */
    public function getPlazo()
    {
        return $this->plazo;
    }
}