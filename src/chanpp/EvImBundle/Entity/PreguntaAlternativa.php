<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PreguntaAlternativa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PreguntaAlternativa
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
     * @ORM\Column(name="enunciado", type="text")
     */
    private $enunciado;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="eje", type="integer")
     */
    private $eje;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeropregunta", type="integer")
     */
    private $numeropregunta;

    /**
     * @var array
     *
     * @ORM\Column(name="alternativas", type="array")
     */
    private $alternativas;

    /**
     * @ORM\ManyToOne(targetEntity="Cuestionario")
     * @ORM\JoinColumn(name="cuestionario_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $cuestionario;

    /**
     * @ORM\OneToMany(targetEntity="RespuestaAlternativa", mappedBy="pregunta")
     */
    protected $respuestas;

    /**
     * @ORM\OneToMany(targetEntity="PreguntaAlternativa", mappedBy="preguntapadre")
     */
    protected $preguntashijas;

    /**
     * @ORM\ManyToOne(targetEntity="PreguntaAlternativa")
     * @ORM\JoinColumn(name="preguntapadre_id", referencedColumnName="id")
     */
    protected $preguntapadre;

     public function __construct()
    {
        $this->respuestas = new ArrayCollection();
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
     * Set enunciado
     *
     * @param string $enunciado
     * @return PreguntaAlternativa
     */
    public function setEnunciado($enunciado)
    {
        $this->enunciado = $enunciado;
    
        return $this;
    }

    /**
     * Get enunciado
     *
     * @return string 
     */
    public function getEnunciado()
    {
        return $this->enunciado;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return PreguntaAlternativa
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set eje
     *
     * @param integer $eje
     * @return PreguntaAlternativa
     */
    public function setEje($eje)
    {
        $this->eje = $eje;
    
        return $this;
    }

    /**
     * Get eje
     *
     * @return integer 
     */
    public function getEje()
    {
        return $this->eje;
    }

    /**
     * Set numeropregunta
     *
     * @param integer $numeropregunta
     * @return PreguntaAlternativa
     */
    public function setNumeropregunta($numeropregunta)
    {
        $this->numeropregunta = $numeropregunta;
    
        return $this;
    }

    /**
     * Get numeropregunta
     *
     * @return integer 
     */
    public function getNumeropregunta()
    {
        return $this->numeropregunta;
    }

     /**
     * Set alternativas
     *
     * @param array $alternativas
     * @return PreguntaAlternativa
     */
    public function setAlternativas($alternativas)
    {
        $this->alternativas = $alternativas;
    
        return $this;
    }

    /**
     * Get alternativas
     *
     * @return array 
     */
    public function getAlternativas()
    {
        return $this->alternativas;
    }

    /**
     * Set cuestionario
     *
     * @param \chanpp\EvImBundle\Entity\Cuestionario $cuestionario
     * @return PreguntaAlternativa
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
     * Add respuestas
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas
     * @return PreguntaAlternativa
     */
    public function addRespuesta(\chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas)
    {
        $this->respuestas[] = $respuestas;
    
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas
     */
    public function removeRespuesta(\chanpp\EvImBundle\Entity\RespuestaAlternativa $respuestas)
    {
        $this->respuestas->removeElement($respuestas);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Get respuestas resumen
     *
     * @return array
     */
    public function getRespuestasResumen(){

        $data = array();
        foreach ($this->respuestas as $r_alt) {
            $data[] = $r_alt->getRespuesta();
        }

        $resumen = array_count_values($data);
        //$resumen = asort($resumen);

        if($this->tipo == 1){
            $resumen["Si"] = $resumen[1];
            $resumen["No"] = $resumen[2];
            unset($resumen[1]);
            unset($resumen[2]);
        }
        else if($this->tipo == 2){
            krsort($resumen);
        } 
        else if($this->tipo == 3){
            krsort($resumen);

            foreach ($resumen as $key => $value) {
                $resumen[$this->getAlternativas()[$key]] = $resumen[$key];
                unset($resumen[$key]);
            }

        }

        return $resumen;
    }

    /**
     * Add preguntashijas
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntashijas
     * @return PreguntaAlternativa
     */
    public function addPreguntashija(\chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntashijas)
    {
        $this->preguntashijas[] = $preguntashijas;
    
        return $this;
    }

    /**
     * Remove preguntashijas
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntashijas
     */
    public function removePreguntashija(\chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntashijas)
    {
        $this->preguntashijas->removeElement($preguntashijas);
    }

    /**
     * Get preguntashijas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntashijas()
    {
        return $this->preguntashijas;
    }

    /**
     * Set preguntapadre
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntapadre
     * @return PreguntaAlternativa
     */
    public function setPreguntapadre(\chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntapadre = null)
    {
        $this->preguntapadre = $preguntapadre;
    
        return $this;
    }

    /**
     * Get preguntapadre
     *
     * @return \chanpp\EvImBundle\Entity\PreguntaAlternativa 
     */
    public function getPreguntapadre()
    {
        return $this->preguntapadre;
    }
}