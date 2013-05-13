<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

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
     * @var string
     *
     * @ORM\Column(name="duracion", type="string", length=255)
     */
    private $duracion;

    /**
     * @var string
     *
     * @ORM\Column(name="confiabilidad", type="text")
     */
    private $confiabilidad;

    /**
     * @ORM\OneToMany(targetEntity="EvaluacionIndirecta", mappedBy="evaluacion")
     */
    protected $evaluacionesindirectas;

    /**
     * @ORM\ManyToOne(targetEntity="PlanEvaluacion")
     * @ORM\JoinColumn(name="planevaluacion_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $planevaluacion;

  
   /**
     * @var ArrayCollection $actividades
     * @ORM\ManyToMany(targetEntity="Activity", inversedBy="evaluaciones", cascade={"persist"})
     * @ORM\JoinTable(
     *      name="activity_evaluacion",
     *      joinColumns={@ORM\JoinColumn(name="evaluacion_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="actividad_id", referencedColumnName="id")}
     * )
     */
    protected $actividades;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="done", type="boolean")
     */
    private $done;
    
    public function __construct()
    {
        $this->evaluacionesindirectas = new ArrayCollection();
        $this->actividades = new ArrayCollection();
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

    /**
     * Add evaluacionesindirectas
     *
     * @param \chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas
     * @return Evaluacion
     */
    public function addEvaluacionesindirecta(\chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas)
    {
        $this->evaluacionesindirectas[] = $evaluacionesindirectas;
    
        return $this;
    }

    /**
     * Remove evaluacionesindirectas
     *
     * @param \chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas
     */
    public function removeEvaluacionesindirecta(\chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionesindirectas)
    {
        $this->evaluacionesindirectas->removeElement($evaluacionesindirectas);
    }

    /**
     * Get evaluacionesindirectas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluacionesindirectas()
    {
        return $this->evaluacionesindirectas;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Evaluacion
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
     * Set planevaluacion
     *
     * @param \chanpp\EvImBundle\Entity\PlanEvaluacion $planevaluacion
     * @return Evaluacion
     */
    public function setPlanevaluacion(\chanpp\EvImBundle\Entity\PlanEvaluacion $planevaluacion = null)
    {
        $this->planevaluacion = $planevaluacion;
    
        return $this;
    }

    /**
     * Get planevaluacion
     *
     * @return \chanpp\EvImBundle\Entity\PlanEvaluacion 
     */
    public function getPlanevaluacion()
    {
        return $this->planevaluacion;
    }


    /**
     * Add actividades
     *
     * @param \chanpp\EvImBundle\Entity\Activity $actividades
     * @return Evaluacion
     */
    public function addActividade(\chanpp\EvImBundle\Entity\Activity $actividades)
    {
        $this->actividades[] = $actividades;
    
        return $this;
    }

    /**
     * Remove actividades
     *
     * @param \chanpp\EvImBundle\Entity\Activity $actividades
     */
    public function removeActividade(\chanpp\EvImBundle\Entity\Activity $actividades)
    {
        $this->actividades->removeElement($actividades);
    }

    /**
     * Get actividades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * Set actividades
     * @param \chanpp\EvImBundle\Entity\Activity $actividades
     * @return Evaluacion
     */
    public function setActividades(\chanpp\EvImBundle\Entity\Activity $actividades = null)
    {
        $this->actividades = $actividades;
    
        return $this;
    }

    /**
     * Set done
     *
     * @param boolean $done
     * @return Evaluacion
     */
    public function setDone($done)
    {
        $this->done = $done;
        if($this->getDone())
        {
            #Set as done everything else that depends on this
            $evaluacionesindirectas = $this->getEvaluacionesindirectas();
            foreach ($evaluacionesindirectas as $eindirecta) {
                $cuestionario = $eindirecta->getCuestionario();
                if($cuestionario)
                {
                    $cuestionario->setDone(true);
                }
            }
        }
        return $this;
    }

    /**
     * Get done
     *
     * @return boolean 
     */
    public function getDone()
    {
        return $this->done;
    }
}