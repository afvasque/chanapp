<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * IndGestion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class IndGestion
{
    /**
     * @ORM\OneToMany(targetEntity="Meta", mappedBy="ind_gestion", cascade={"persist", "remove"})
     */
    protected $metas;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text")
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="FichaProyecto", inversedBy="ind_gestions")
     * @ORM\JoinColumn(name="ficha_proyecto_id", referencedColumnName="id")
     */
    protected $ficha_proyecto;

    public function __construct()
    {
        $this->metas = new ArrayCollection();
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
     * @var integer
     *
     * @ORM\Column(name="ano_deadline", type="integer")
     */
    private $anoDeadline;

    /**
     * @var string
     *
     * @ORM\Column(name="mes_deadline", type="string", length=10)
     */
    private $mesDeadline;

    /**
     * @var string
     *
     * @ORM\Column(name="variables_obstaculo", type="text")
     */
    private $variables_obstaculo;


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
     * Set anoDeadline
     *
     * @param integer $anoDeadline
     * @return IndGestion
     */
    public function setAnoDeadline($anoDeadline)
    {
        $this->anoDeadline = $anoDeadline;
    
        return $this;
    }

    /**
     * Get anoDeadline
     *
     * @return integer 
     */
    public function getAnoDeadline()
    {
        return $this->anoDeadline;
    }

    /**
     * Set mesDeadline
     *
     * @param string $mesDeadline
     * @return IndGestion
     */
    public function setMesDeadline($mesDeadline)
    {
        $this->mesDeadline = $mesDeadline;
    
        return $this;
    }

    /**
     * Get mesDeadline
     *
     * @return string 
     */
    public function getMesDeadline()
    {
        return $this->mesDeadline;
    }

    /**
     * Add metas
     *
     * @param \chanpp\EvImBundle\Entity\Meta $metas
     * @return IndGestion
     */
    public function addMeta(\chanpp\EvImBundle\Entity\Meta $metas)
    {
        $metas->setIndGestion($this);
        $this->metas[] = $metas;
    
        return $this;
    }

    /**
     * Remove metas
     *
     * @param \chanpp\EvImBundle\Entity\Meta $metas
     */
    public function removeMeta(\chanpp\EvImBundle\Entity\Meta $metas)
    {
        $this->metas->removeElement($metas);
    }

    /**
     * Get metas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMetas()
    {
        return $this->metas;
    }

    /**
     * Set ficha_proyecto
     *
     * @param \chanpp\EvImBundle\Entity\FichaProyecto $fichaProyecto
     * @return IndGestion
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
     * Set variables_obstaculo
     *
     * @param string $variablesObstaculo
     * @return IndGestion
     */
    public function setVariablesObstaculo($variablesObstaculo)
    {
        $this->variables_obstaculo = $variablesObstaculo;
    
        return $this;
    }

    /**
     * Get variables_obstaculo
     *
     * @return string 
     */
    public function getVariablesObstaculo()
    {
        return $this->variables_obstaculo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return IndGestion
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
}