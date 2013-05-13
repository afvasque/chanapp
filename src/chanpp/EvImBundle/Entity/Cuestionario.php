<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cuestionario
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cuestionario
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
     * @ORM\OneToMany(targetEntity="PreguntaAlternativa", mappedBy="cuestionario")
     */
    protected $preguntasalternativa;

    /**
     * @ORM\OneToMany(targetEntity="PreguntaDesarrollo", mappedBy="cuestionario")
     */
    protected $preguntasdesarrollo;

     /**
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="cuestionario")
     */
    protected $respuestas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="done", type="boolean")
     */
    private $done;

    /**
     * @ORM\OneToOne(targetEntity="EvaluacionIndirecta", inversedBy="cuestionario")
     * @ORM\JoinColumn(name="evaluacionindirecta_id", referencedColumnName="id")
     */
    protected $evaluacionindirecta;

    public function __construct()
    {
        $this->preguntasalternativa = new ArrayCollection();
        $this->preguntasdesarrollo = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Cuestionario
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
     * Add preguntasalternativa
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa
     * @return Cuestionario
     */
    public function addPreguntasalternativa(\chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa)
    {
        $this->preguntasalternativa[] = $preguntasalternativa;
    
        return $this;
    }

    /**
     * Remove preguntasalternativa
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa
     */
    public function removePreguntasalternativa(\chanpp\EvImBundle\Entity\PreguntaAlternativa $preguntasalternativa)
    {
        $this->preguntasalternativa->removeElement($preguntasalternativa);
    }

    /**
     * Get preguntasalternativa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntasalternativa()
    {
        return $this->preguntasalternativa;
    }

    /**
     * Add preguntasdesarrollo
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntasdesarrollo
     * @return Cuestionario
     */
    public function addPreguntasdesarrollo(\chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntasdesarrollo)
    {
        $this->preguntasdesarrollo[] = $preguntasdesarrollo;
    
        return $this;
    }

    /**
     * Remove preguntasdesarrollo
     *
     * @param \chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntasdesarrollo
     */
    public function removePreguntasdesarrollo(\chanpp\EvImBundle\Entity\PreguntaDesarrollo $preguntasdesarrollo)
    {
        $this->preguntasdesarrollo->removeElement($preguntasdesarrollo);
    }

    /**
     * Get preguntasdesarrollo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntasdesarrollo()
    {
        return $this->preguntasdesarrollo;
    }

    /**
     * Get all questions, sorted
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntasSorted()
    {
        $question_number = count($this->getPreguntasdesarrollo()) + count($this->getPreguntasalternativa());
        $preguntasdesarrollo = $this->getPreguntasdesarrollo();
        $preguntasalternativa = $this->getPreguntasalternativa();
        $preguntas = new ArrayCollection();
        $counter = 1;
        while($question_number >= $counter)
        {   
            #We check all the questions for the currently needed one
            foreach($preguntasdesarrollo as  &$pregunta)
            {
                if($pregunta->getNumeropregunta() == $counter)
                {
                     $preguntas[] = $pregunta;
                }
            }
            foreach($preguntasalternativa as  &$pregunta)
            {
                if($pregunta->getNumeropregunta() == $counter)
                {
                     $preguntas[] = $pregunta;
                }
            }
            $counter++;
        }

        return $preguntas;
    }



    /**
     * Add respuestas
     *
     * @param \chanpp\EvImBundle\Entity\Respuesta $respuestas
     * @return Cuestionario
     */
    public function addRespuesta(\chanpp\EvImBundle\Entity\Respuesta $respuestas)
    {
        $this->respuestas[] = $respuestas;
    
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \chanpp\EvImBundle\Entity\Respuesta $respuestas
     */
    public function removeRespuesta(\chanpp\EvImBundle\Entity\Respuesta $respuestas)
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
     * Set done
     *
     * @param boolean $done
     * @return Cuestionario
     */
    public function setDone($done)
    {
        $this->done = $done;
    
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

    /**
     * Set evaluacionindirecta
     *
     * @param \chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionindirecta
     * @return Cuestionario
     */
    public function setEvaluacionindirecta(\chanpp\EvImBundle\Entity\EvaluacionIndirecta $evaluacionindirecta = null)
    {
        $this->evaluacionindirecta = $evaluacionindirecta;
    
        return $this;
    }

    /**
     * Get evaluacionindirecta
     *
     * @return \chanpp\EvImBundle\Entity\EvaluacionIndirecta 
     */
    public function getEvaluacionindirecta()
    {
        return $this->evaluacionindirecta;
    }
}