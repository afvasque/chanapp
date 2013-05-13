<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * FichaProyecto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FichaProyecto
{
    const Edificacion = "Edificación";
    const Educacion_y_Capacitacion = "Educación y Capacitación";
    const Transporte = "Transporte"; 
    const Industria_y_Minería = "Industria y Minería";
    const Medición_y_Verificación = "Medición y Verificación";
    const Desarrollo_de_Negocios = "Desarrollo de Negocios";
    /**
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="ficha_proyecto", cascade={"persist", "remove"})
     */
    protected $activities;
    /**
    * @ORM\OneToMany(targetEntity="IndGestion", mappedBy="ficha_proyecto", cascade={"persist", "remove"})
    */
    protected $ind_gestions;

    /**
     * @ORM\OneToMany(targetEntity="PlanEvaluacion", mappedBy="fichaproyecto")
     */
    protected $planevaluaciones;
    
    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->ind_gestions = new ArrayCollection();
    }

    public function __toString() {
        return $this->nombre;
    }
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
     * @ORM\Column(name="area_accion", type="string", length=255)
     */
    private $area_accion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_editor", type="string", length=255, nullable=true)
     */
    private $nombre_editor;

    /**
     * @var string
     *
     * @ORM\Column(name="linea_accion", type="string", length=255)
     */
    private $linea_accion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="jefe", type="string", length=255)
     */
    private $jefe;

    /**
     * @var string
     *
     * @ORM\Column(name="duracion", type="string", length=255)
     */
    private $duracion;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico_previo", type="text")
     */
    private $diagnostico_previo;

    /**
     * @var string
     *
     * @ORM\Column(name="obj_general", type="string", length=255)
     */
    private $obj_general;

    /**
     * @var string
     *
     * @ORM\Column(name="objs_especificos", type="text")
     */
    private $objs_especificos;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_causales", type="text")
     */
    private $desc_causales;

    /**
     * @var string
     *
     * @ORM\Column(name="variables_causales", type="text")
     */
    private $variables_causales;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $modified_at;

    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setModifiedAt(new \DateTime(date('Y-m-d H:i:s')));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
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
     * Set area_accion
     *
     * @param string $areaAccion
     * @return FichaProyecto
     */
    public function setAreaAccion($areaAccion)
    {
        $this->area_accion = $areaAccion;
    
        return $this;
    }

    /**
     * Get area_accion
     *
     * @return string 
     */
    public function getAreaAccion()
    {
        return $this->area_accion;
    }

    /**
     * Set linea_accion
     *
     * @param string $lineaAccion
     * @return FichaProyecto
     */
    public function setLineaAccion($lineaAccion)
    {
        $this->linea_accion = $lineaAccion;
    
        return $this;
    }

    /**
     * Get linea_accion
     *
     * @return string 
     */
    public function getLineaAccion()
    {
        return $this->linea_accion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return FichaProyecto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set jefe
     *
     * @param string $jefe
     * @return FichaProyecto
     */
    public function setJefe($jefe)
    {
        $this->jefe = $jefe;
    
        return $this;
    }

    /**
     * Get jefe
     *
     * @return string 
     */
    public function getJefe()
    {
        return $this->jefe;
    }

    /**
     * Set diagnostico_previo
     *
     * @param string $diagnosticoPrevio
     * @return FichaProyecto
     */
    public function setDiagnosticoPrevio($diagnosticoPrevio)
    {
        $this->diagnostico_previo = $diagnosticoPrevio;
    
        return $this;
    }

    /**
     * Get diagnostico_previo
     *
     * @return string 
     */
    public function getDiagnosticoPrevio()
    {
        return $this->diagnostico_previo;
    }

    /**
     * Set obj_general
     *
     * @param string $objGeneral
     * @return FichaProyecto
     */
    public function setObjGeneral($objGeneral)
    {
        $this->obj_general = $objGeneral;
    
        return $this;
    }

    /**
     * Get obj_general
     *
     * @return string 
     */
    public function getObjGeneral()
    {
        return $this->obj_general;
    }

    /**
     * Set objs_especificos
     *
     * @param string $objsEspecificos
     * @return FichaProyecto
     */
    public function setObjsEspecificos($objsEspecificos)
    {
        $this->objs_especificos = $objsEspecificos;
    
        return $this;
    }

    /**
     * Get objs_especificos
     *
     * @return string 
     */
    public function getObjsEspecificos()
    {
        return $this->objs_especificos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return FichaProyecto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set desc_causales
     *
     * @param string $descCausales
     * @return FichaProyecto
     */
    public function setDescCausales($descCausales)
    {
        $this->desc_causales = $descCausales;
    
        return $this;
    }

    /**
     * Get desc_causales
     *
     * @return string 
     */
    public function getDescCausales()
    {
        return $this->desc_causales;
    }

    /**
     * Set variables_causales
     *
     * @param string $variablesCausales
     * @return FichaProyecto
     */
    public function setVariablesCausales($variablesCausales)
    {
        $this->variables_causales = $variablesCausales;
    
        return $this;
    }

    /**
     * Get variables_causales
     *
     * @return string 
     */
    public function getVariablesCausales()
    {
        return $this->variables_causales;
    }

    /**
     * Add activities
     *
     * @param \chanpp\EvImBundle\Entity\Activity $activities
     * @return FichaProyecto
     */
    public function addActivitie(\chanpp\EvImBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;
    
        return $this;
    }

    /**
     * Remove activities
     *
     * @param \chanpp\EvImBundle\Entity\Activity $activities
     */
    public function removeActivitie(\chanpp\EvImBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivities()
    {
        return $this->activities;
    }

    public function setActivities($activities)
    {
        foreach ($activities as $activity) {
            $activity->setFichaProyecto($this);
        }
        $this->activities = $activities;
    }

    /**
     * Add ind_gestions
     *
     * @param \chanpp\EvImBundle\Entity\IndGestion $indGestions
     * @return FichaProyecto
     */
    public function addIndGestion(\chanpp\EvImBundle\Entity\IndGestion $indGestions)
    {
        $this->ind_gestions[] = $indGestions;
    
        return $this;
    }

    /**
     * Remove ind_gestions
     *
     * @param \chanpp\EvImBundle\Entity\IndGestion $indGestions
     */
    public function removeIndGestion(\chanpp\EvImBundle\Entity\IndGestion $indGestions)
    {
        $this->ind_gestions->removeElement($indGestions);
    }

    /**
     * Get ind_gestions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIndGestions()
    {
        return $this->ind_gestions;
    }

    /**
     * Add evaluaciones
     *
     * @param \chanpp\EvImBundle\Entity\Evaluacion $evaluaciones
     * @return FichaProyecto
     */
    public function addEvaluacione(\chanpp\EvImBundle\Entity\Evaluacion $evaluaciones)
    {
        $this->evaluaciones[] = $evaluaciones;
    
        return $this;
    }

    public static function getAreasAccion()
    {
        return array(
            self::Edificacion => 'Edificacion',
            self::Educacion_y_Capacitacion => 'Educación y Capacitación',
            self::Transporte => 'Transporte',
            self::Industria_y_Minería => 'Industria y Minería',
            self::Medición_y_Verificación => 'Medición y Verificación',
            self::Desarrollo_de_Negocios => 'Desarrollo de Negocios',
            );
    }


    /**
     * Set nombre_editor
     *
     * @param string $nombreEditor
     * @return FichaProyecto
     */
    public function setNombreEditor($nombreEditor)
    {
        $this->nombre_editor = $nombreEditor;
    
        return $this;
    }

    /**
     * Get nombre_editor
     *
     * @return string 
     */
    public function getNombreEditor()
    {
        return $this->nombre_editor;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return FichaProyecto
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set modified_at
     *
     * @param \DateTime $modifiedAt
     * @return FichaProyecto
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modified_at = $modifiedAt;
    
        return $this;
    }

    /**
     * Get modified_at
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * Set duracion
     *
     * @param string $duracion
     * @return FichaProyecto
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return string 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Add activities
     *
     * @param \chanpp\EvImBundle\Entity\Activity $activities
     * @return FichaProyecto
     */
    public function addActivity(\chanpp\EvImBundle\Entity\Activity $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \chanpp\EvImBundle\Entity\Activity $activities
     */
    public function removeActivity(\chanpp\EvImBundle\Entity\Activity $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Add planevaluaciones
     *
     * @param \chanpp\EvImBundle\Entity\PlanEvaluacion $planevaluaciones
     * @return FichaProyecto
     */
    public function addPlanevaluacione(\chanpp\EvImBundle\Entity\PlanEvaluacion $planevaluaciones)
    {
        $this->planevaluaciones[] = $planevaluaciones;

        return $this;
    }

    /**
     * Remove planevaluaciones
     *
     * @param \chanpp\EvImBundle\Entity\PlanEvaluacion $planevaluaciones
     */
    public function removePlanevaluacione(\chanpp\EvImBundle\Entity\PlanEvaluacion $planevaluaciones)
    {
        $this->planevaluaciones->removeElement($planevaluaciones);
    }

    /**
     * Get planevaluaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlanevaluaciones()
    {
        return $this->planevaluaciones;
    }
}
