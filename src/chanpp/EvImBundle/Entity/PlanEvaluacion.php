<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanEvaluacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PlanEvaluacion
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
     * @ORM\Column(name="id_ficha_proyecto", type="integer")
     */
    private $idFichaProyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivos", type="text")
     */
    private $objetivos;

    /**
     * @var string
     *
     * @ORM\Column(name="destinatarios", type="text")
     */
    private $destinatarios;

    /**
     * @var integer
     *
     * @ORM\Column(name="instancias_numero_evaluaciones", type="integer")
     */
    private $instanciasNumeroEvaluaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="instancias_plazo", type="string", length=255)
     */
    private $instanciasPlazo;


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
     * Set objetivos
     *
     * @param string $objetivos
     * @return PlanEvaluacion
     */
    public function setObjetivos($objetivos)
    {
        $this->objetivos = $objetivos;
    
        return $this;
    }

    /**
     * Get objetivos
     *
     * @return string 
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }

    /**
     * Set destinatarios
     *
     * @param string $destinatarios
     * @return PlanEvaluacion
     */
    public function setDestinatarios($destinatarios)
    {
        $this->destinatarios = $destinatarios;
    
        return $this;
    }

    /**
     * Get destinatarios
     *
     * @return string 
     */
    public function getDestinatarios()
    {
        return $this->destinatarios;
    }

    /**
     * Set instanciasNumeroEvaluaciones
     *
     * @param integer $instanciasNumeroEvaluaciones
     * @return PlanEvaluacion
     */
    public function setInstanciasNumeroEvaluaciones($instanciasNumeroEvaluaciones)
    {
        $this->instanciasNumeroEvaluaciones = $instanciasNumeroEvaluaciones;
    
        return $this;
    }

    /**
     * Get instanciasNumeroEvaluaciones
     *
     * @return integer 
     */
    public function getInstanciasNumeroEvaluaciones()
    {
        return $this->instanciasNumeroEvaluaciones;
    }

    /**
     * Set instanciasPlazo
     *
     * @param string $instanciasPlazo
     * @return PlanEvaluacion
     */
    public function setInstanciasPlazo($instanciasPlazo)
    {
        $this->instanciasPlazo = $instanciasPlazo;
    
        return $this;
    }

    /**
     * Get instanciasPlazo
     *
     * @return string 
     */
    public function getInstanciasPlazo()
    {
        return $this->instanciasPlazo;
    }

    /**
     * Get idFichaProyecto
     *
     * @return string 
     */
    public function getIdFichaProyecto()
    {
        return $this->idFichaProyecto;
    }

    /**
     * Set idFichaProyecto
     *
     * @param integer $idFichaProyecto
     * @return PlanEvaluacion
     */
    public function setIdFichaProyecto($idFichaProyecto)
    {
        $this->idFichaProyecto = $idFichaProyecto;
    
        return $this;
    }
}