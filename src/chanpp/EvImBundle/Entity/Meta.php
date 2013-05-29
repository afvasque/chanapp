<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Meta
{
    /**
     * @ORM\ManyToOne(targetEntity="IndGestion", inversedBy="metas")
     * @ORM\JoinColumn(name="ind_gestion_id", referencedColumnName="id")
     */
    protected $ind_gestion;

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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text")
     */
    private $nombre;

/*    /**
     * @var integer
     *
     * @ORM\Column(name="plazo_mes", type="integer")
     
    private $plazoMes;

    /**
     * @var integer
     *
     * @ORM\Column(name="plazo_anio", type="integer")
     
    private $plazoAnio;*/

    /**
     * @var string
     *
     * @ORM\Column(name="plazo", type="string")
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Meta
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
     * Set plazoMes
     *
     * @param integer $plazoMes
     * @return Meta
     */
    public function setPlazo($plazo)
    {
        $this->plazo = $plazo;
    
        return $this;
    }

    /**
     * Get plazoMes
     *
     * @return integer 
     */
    public function getPlazo()
    {
        return $this->plazo;
    }

   
    /**
     * Set meta
     *
     * @param \chanpp\EvImBundle\Entity\IndGestion $meta
     * @return Meta
     */
    public function setIndGestion(\chanpp\EvImBundle\Entity\IndGestion $ind_gestion = null)
    {
        $this->ind_gestion = $ind_gestion;
    
        return $this;
    }

    /**
     * Get meta
     *
     * @return \chanpp\EvImBundle\Entity\IndGestion 
     */
    public function getIndGestion()
    {
        return $this->ind_gestion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Meta
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
