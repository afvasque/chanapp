<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="Recurso", mappedBy="planevaluacion")
     */
    protected $recursos;

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
     * @ORM\OneToMany(targetEntity="Evaluacion", mappedBy="planeevaluacion")
     */
    protected $evaluaciones;

     /**
     * @ORM\ManyToOne(targetEntity="FichaProyecto", inversedBy="planeevaluaciones")
     * @ORM\JoinColumn(name="fichaproyecto_id", referencedColumnName="id")
     */
    protected $fichaproyecto;

    /**
     * @ORM\OneToMany(targetEntity="CambiosPlanEvaluacion", mappedBy="planevaluacion")
     */
    protected $cambios;

    public function __construct()
    {
        $this->recursos = new ArrayCollection();
        $this->evaluaciones = new ArrayCollection();
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
     * Add recursos
     *
     * @param \chanpp\EvImBundle\Entity\Recurso $recursos
     * @return PlanEvaluacion
     */
    public function addRecurso(\chanpp\EvImBundle\Entity\Recurso $recursos)
    {
        $this->recursos[] = $recursos;
    
        return $this;
    }

    /**
     * Remove recursos
     *
     * @param \chanpp\EvImBundle\Entity\Recurso $recursos
     */
    public function removeRecurso(\chanpp\EvImBundle\Entity\Recurso $recursos)
    {
        $this->recursos->removeElement($recursos);
    }

    /**
     * Get recursos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecursos()
    {
        return $this->recursos;
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


    /**
     * Add evaluaciones
     *
     * @param \chanpp\EvImBundle\Entity\Evaluacion $evaluaciones
     * @return PlanEvaluacion
     */
    public function addEvaluacione(\chanpp\EvImBundle\Entity\Evaluacion $evaluaciones)
    {
        $this->evaluaciones[] = $evaluaciones;
    
        return $this;
    }

    /**
     * Remove evaluaciones
     *
     * @param \chanpp\EvImBundle\Entity\Evaluacion $evaluaciones
     */
    public function removeEvaluacione(\chanpp\EvImBundle\Entity\Evaluacion $evaluaciones)
    {
        $this->evaluaciones->removeElement($evaluaciones);
    }

    /**
     * Get evaluaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluaciones()
    {
        return $this->evaluaciones;
    }

    /**
     * Set fichaproyecto
     *
     * @param \chanpp\EvImBundle\Entity\FichaProyecto $fichaproyecto
     * @return PlanEvaluacion
     */
    public function setFichaproyecto(\chanpp\EvImBundle\Entity\FichaProyecto $fichaproyecto = null)
    {
        $this->fichaproyecto = $fichaproyecto;
    
        return $this;
    }

    /**
     * Get fichaproyecto
     *
     * @return \chanpp\EvImBundle\Entity\FichaProyecto 
     */
    public function getFichaproyecto()
    {
        return $this->fichaproyecto;
    }

    /**
     * Add cambios
     *
     * @param \chanpp\EvImBundle\Entity\CambiosPlanEvaluacion $cambios
     * @return PlanEvaluacion
     */
    public function addCambio(\chanpp\EvImBundle\Entity\CambiosPlanEvaluacion $cambios)
    {
        $this->cambios[] = $cambios;

        return $this;
    }

    /**
     * Remove cambios
     *
     * @param \chanpp\EvImBundle\Entity\CambiosPlanEvaluacion $cambios
     */
    public function removeCambio(\chanpp\EvImBundle\Entity\CambiosPlanEvaluacion $cambios)
    {
        $this->cambios->removeElement($cambios);
    }

    /**
     * Get cambios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCambios()
    {
        return $this->cambios;
    }
}
