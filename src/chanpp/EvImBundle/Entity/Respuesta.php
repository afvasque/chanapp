<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Respuesta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Respuesta
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
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=255)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @ORM\ManyToOne(targetEntity="Cuestionario")
     * @ORM\JoinColumn(name="cuestionario_id", referencedColumnName="id",onDelete="CASCADE")
     */
    protected $cuestionario;

    /**
     * @ORM\OneToMany(targetEntity="RespuestaAlternativa", mappedBy="respuesta_parent")
     */
    protected $respuestasalternativas;

    /**
     * @ORM\OneToMany(targetEntity="RespuestaDesarrollo", mappedBy="respuesta_parent")
     */
    protected $respuestasdesarrollos;

    public function __construct()
    {
        $this->respuestasalternativas = new ArrayCollection();
        $this->respuestasdesarrollos = new ArrayCollection();
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
     * @return Respuesta
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
     * Set empresa
     *
     * @param string $empresa
     * @return Respuesta
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Respuesta
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Respuesta
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set cuestionario
     *
     * @param \chanpp\EvImBundle\Entity\Cuestionario $cuestionario
     * @return Respuesta
     */
    public function setCuestionario(\chanpp\EvImBundle\Entity\Cuestionario $cuestionario = null)
    {
        $this->cuestionario = $cuestionario;
    
        return $this;
    }

    /**
     * Get cuestionario
     *
     * @return \chanpp\EvImBundle\Entity\Cuestionario 
     */
    public function getCuestionario()
    {
        return $this->cuestionario;
    }

    /**
     * Add respuestasalternativas
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestasalternativas
     * @return Respuesta
     */
    public function addRespuestasalternativa(\chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestasalternativas)
    {
        $this->respuestasalternativas[] = $respuestasalternativas;
    
        return $this;
    }

    /**
     * Remove respuestasalternativas
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestasalternativas
     */
    public function removeRespuestasalternativa(\chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestasalternativas)
    {
        $this->respuestasalternativas->removeElement($respuestasalternativas);
    }

    /**
     * Get respuestasalternativas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestasalternativas()
    {
        return $this->respuestasalternativas;
    }

    /**
     * Add respuestasdesarrollos
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaDesarrollo $respuestasdesarrollos
     * @return Respuesta
     */
    public function addRespuestasdesarrollo(\chanpp\EvImBundle\Entity\RespuestaDesarrollo $respuestasdesarrollos)
    {
        $this->respuestasdesarrollos[] = $respuestasdesarrollos;
    
        return $this;
    }

    /**
     * Remove respuestasdesarrollos
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaDesarrollo $respuestasdesarrollos
     */
    public function removeRespuestasdesarrollo(\chanpp\EvImBundle\Entity\RespuestaDesarrollo $respuestasdesarrollos)
    {
        $this->respuestasdesarrollos->removeElement($respuestasdesarrollos);
    }

    /**
     * Get respuestasdesarrollos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestasdesarrollos()
    {
        return $this->respuestasdesarrollos;
    }

    /**
     * Get all respuestas, sorted
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestasSorted()
    {
        $respuesta_number = count($this->getRespuestasdesarrollos()) + count($this->getRespuestasalternativas());
        $respuestasdesarrollo = $this->getRespuestasdesarrollos();
        $respuestasalternativa = $this->getRespuestasalternativas();
        $respuestas = new ArrayCollection();
        $counter = 1;
        while($respuesta_number >= $counter)
        {   
            #We check all the respuestas for the currently needed one
            foreach($respuestasdesarrollo as  &$respuesta)
            {
                if($respuesta->getPregunta()->getNumeropregunta() == $counter)
                {
                     $respuestas[] = $respuesta;
                }
            }
            foreach($respuestasalternativa as  &$respuesta)
            {
                if($respuesta->getPregunta()->getNumeropregunta() == $counter)
                {
                     $respuestas[] = $respuesta;
                }
            }
            $counter++;
        }

        return $respuestas;
    }
}