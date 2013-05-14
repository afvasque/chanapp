<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CambiosPlanEvaluacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CambiosPlanEvaluacion
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
     * @ORM\Column(name="comentario", type="text")
     */
    private $comentario;

    /**
     * @ORM\ManyToOne(targetEntity="PlanEvaluacion", inversedBy="cambios")
     * @ORM\JoinColumn(name="planevaluacion_id", referencedColumnName="id")
     */
    protected $planevaluacion;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="text")
     */
    private $username;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fechahoracambio;

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
     * Set comentario
     *
     * @param string $comentario
     * @return CambiosPlanEvaluacion
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set planevaluacion
     *
     * @param \chanpp\EvImBundle\Entity\PlanEvaluacion $planevaluacion
     * @return CambiosPlanEvaluacion
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
     * Set username
     *
     * @param string $username
     * @return CambiosPlanEvaluacion
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set fechahoracambio
     *
     * @param \DateTime $fechahoracambio
     * @return CambiosPlanEvaluacion
     */
    public function setFechahoracambio($fechahoracambio)
    {
        $this->fechahoracambio = $fechahoracambio;

        return $this;
    }

    /**
     * Get fechahoracambio
     *
     * @return \DateTime 
     */
    public function getFechahoracambio()
    {
        return $this->fechahoracambio;
    }
}
