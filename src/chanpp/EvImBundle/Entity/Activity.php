<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Activity
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Activity
{
    /**
     * @ORM\ManyToOne(targetEntity="FichaProyecto", inversedBy="activities")
     * @ORM\JoinColumn(name="ficha_proyecto_id", referencedColumnName="id")
     */
    protected $ficha_proyecto;

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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="resultados_esperados", type="string", length=255)
     */
    private $resultadosEsperados;

    /**
     * @var string
     *
     * @ORM\Column(name="duracion", type="string", length=255)
     */
    private $duracion;

     /**
     * @var ArrayCollection $evaluaciones
     * @ORM\ManyToMany(targetEntity="Evaluacion", mappedBy="actividades", cascade={"persist"})
     */
    protected $evaluaciones;

    public function __construct()
    {
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
     * Set nombre
     *
     * @param string $nombre
     * @return Activity
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Activity
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
     * Set resultadosEsperados
     *
     * @param string $resultadosEsperados
     * @return Activity
     */
    public function setResultadosEsperados($resultadosEsperados)
    {
        $this->resultadosEsperados = $resultadosEsperados;
    
        return $this;
    }

    /**
     * Get resultadosEsperados
     *
     * @return string 
     */
    public function getResultadosEsperados()
    {
        return $this->resultadosEsperados;
    }

    /**
     * Set duracion
     *
     * @param string $duracion
     * @return Activity
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
     * Set ficha_proyecto
     *
     * @param \chanpp\EvImBundle\Entity\FichaProyecto $fichaProyecto
     * @return Activity
     */
    public function setFichaProyecto(\chanpp\EvImBundle\Entity\FichaProyecto $fichaProyecto = null)
    {
        $this->ficha_proyecto = $fichaProyecto;
    
        return $this;
    }

    /**
     * Get ficha_proyecto
     *
     * @return \chanpp\EvImBundle\Entity\FichaProyecto 
     */
    public function getFichaProyecto()
    {
        return $this->ficha_proyecto;
    }

    /**
     * Add evaluaciones
     *
     * @param \chanpp\EvImBundle\Entity\Evaluacion $evaluaciones
     * @return Activity
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
}