<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * EvaluacionIndirecta
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EvaluacionIndirecta
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
     * @var integer
     *
     * @ORM\Column(name="ambito", type="integer")
     */
    private $ambito;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo_interes", type="text")
     */
    private $grupoInteres;

    /**
     * @var array
     *
     * @ORM\Column(name="ejes", type="array")
     */
    private $ejes;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="plazo", type="string", length=255)
     */
    private $plazo;

    /**
     * @ORM\ManyToOne(targetEntity="Evaluacion", inversedBy="evaluacionesindirectas")
     * @ORM\JoinColumn(name="evaluacion_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $evaluacion;

     /**
     * @ORM\OneToOne(targetEntity="Document", mappedBy="evaluacionindirecta")
     */
    protected $document;

    /**
     * @ORM\OneToOne(targetEntity="Cuestionario", mappedBy="evaluacionindirecta")
     */
    protected $cuestionario;

    /**
     * @var ArrayCollection $metodosrecoleccion
     * @ORM\ManyToMany(targetEntity="MetodoRecoleccion", inversedBy="evaluacionesindirectas", cascade={"persist"})
     * @ORM\JoinTable(
     *      name="evaluacionindirecta_metodorecoleccion",
     *      joinColumns={@ORM\JoinColumn(name="evaluacionindirecta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="metodorecoleccion_id", referencedColumnName="id")}
     * )
     */
    private $metodosrecoleccion;

    public function __construct() {
      $this->metodosrecoleccion= new ArrayCollection();
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
     * Set ambito
     *
     * @param integer $ambito
     * @return EvaluacionIndirecta
     */
    public function setAmbito($ambito)
    {
        $this->ambito = $ambito;
    
        return $this;
    }

    /**
     * Get ambito
     *
     * @return integer 
     */
    public function getAmbito()
    {
        return $this->ambito;
    }

    /**
     * Set grupoInteres
     *
     * @param string $grupoInteres
     * @return EvaluacionIndirecta
     */
    public function setGrupoInteres($grupoInteres)
    {
        $this->grupoInteres = $grupoInteres;
    
        return $this;
    }

    /**
     * Get grupoInteres
     *
     * @return string 
     */
    public function getGrupoInteres()
    {
        return $this->grupoInteres;
    }

    /**
     * Set ejes
     *
     * @param array $ejes
     * @return EvaluacionIndirecta
     */
    public function setEjes($ejes)
    {
        $this->ejes = $ejes;
    
        return $this;
    }

    /**
     * Get ejes
     *
     * @return array 
     */
    public function getEjes()
    {
        return $this->ejes;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     * @return EvaluacionIndirecta
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return string 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set plazo
     *
     * @param string $plazo
     * @return EvaluacionIndirecta
     */
    public function setPlazo($plazo)
    {
        $this->plazo = $plazo;
    
        return $this;
    }

    /**
     * Get plazo
     *
     * @return string 
     */
    public function getPlazo()
    {
        return $this->plazo;
    }

    /**
     * Set evaluacion
     *
     * @param \chanpp\EvImBundle\Entity\Evaluacion $evaluacion
     * @return EvaluacionIndirecta
     */
    public function setEvaluacion(\chanpp\EvImBundle\Entity\Evaluacion $evaluacion = null)
    {
        $this->evaluacion = $evaluacion;
    
        return $this;
    }

    /**
     * Get evaluacion
     *
     * @return \chanpp\EvImBundle\Entity\Evaluacion 
     */
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }

    /**
     * Set document
     *
     * @param \chanpp\EvImBundle\Entity\Document $document
     * @return EvaluacionIndirecta
     */
    public function setDocument(\chanpp\EvImBundle\Entity\Document $document = null)
    {
        $this->document = $document;
    
        return $this;
    }

    /**
     * Get document
     *
     * @return \chanpp\EvImBundle\Entity\Document 
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Get impactosejes
     *
     * @return array 
     */
    public function getImpactosejes()
    {
        #It's time to calculate all the impacts
        $impactosejes = new ArrayCollection(); 
        #We get all the questions from the Cuestionario
        if($this->getCuestionario())
        {
            $preguntasalternativas = $this->getCuestionario()->getPreguntasalternativa();
        #Now, for each eje
        for ($i = 1; $i <= 3; $i++) {
            #Check all the questions
            $percetagebottom = 0;
            $percetagetop = 0;

            $counter = 0;

            $cantidadpreguntaseje = 0;
            $totalpercentage = 0;
            foreach ($preguntasalternativas as &$pregunta) {
                if($pregunta->getEje() == $i)
                {
                    #We obtain all the answers linked to this question
                    $respuestas = $pregunta->getRespuestas();
                    #We need to calculate the percentage of questions that responded Sí or 4 or 5
                    $cantidadpreguntaseje++;

                    #We check the answers and calculate the percentages
                    foreach ($respuestas as &$respuesta) {
                        $percetagebottom++;
                        if($pregunta->getTipo() == 1)
                        {
                            if($respuesta->getRespuesta() == 1)
                            {
                                #Increase counter
                                $percetagetop++;
                            } 
                        }
                        else if($pregunta->getTipo() == 2)
                        {
                            if(($respuesta->getRespuesta() == 4) || ($respuesta->getRespuesta() == 5))
                            {
                                #Increase counter
                                $percetagetop++;
                            } 
                        }
                    }
                    #Add to totalpercentage
                    if($percetagebottom == 0)
                    {
                         $totalpercentage += 0; 
                    }
                    else
                    {
                         $totalpercentage += ($percetagetop/$percetagebottom); 
                    }
                                      

                }
            }
            if($cantidadpreguntaseje == 0)
            {
                $impactoeje = 0;
            }
            else
            {
                $impactoeje = ($totalpercentage*100)/$cantidadpreguntaseje;
            }
            
            if($impactoeje == 0)
            {
                 $impactosejes[] = "N/A";
            }
            else if($impactoeje<= 40)
            {
                #Bajo   
                 $impactosejes[] = "Bajo";
            }
            else if( $impactoeje >40 && $impactoeje <= 69)
            {
                #Medio
                 $impactosejes[] = "Medio";
            }
            else
            {
                #Alto
                 $impactosejes[] = "Alto";
            }
        }

        return $impactosejes;
        }
        else
        {
            $impactosejes[] = "N/A";
            $impactosejes[] = "N/A";
            $impactosejes[] = "N/A";
            return $impactosejes;
        }
        
    }

    /**
     * Set cuestionario
     *
     * @param \chanpp\EvImBundle\Entity\Cuestionario $cuestionario
     * @return EvaluacionIndirecta
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
     * Add metodosrecoleccion
     *
     * @param \chanpp\EvImBundle\Entity\MetodoRecoleccion $metodosrecoleccion
     * @return EvaluacionIndirecta
     */
    public function addMetodosrecoleccion(\chanpp\EvImBundle\Entity\MetodoRecoleccion $metodosrecoleccion)
    {
        $this->metodosrecoleccion[] = $metodosrecoleccion;
    
        return $this;
    }

    /**
     * Remove metodosrecoleccion
     *
     * @param \chanpp\EvImBundle\Entity\MetodoRecoleccion $metodosrecoleccion
     */
    public function removeMetodosrecoleccion(\chanpp\EvImBundle\Entity\MetodoRecoleccion $metodosrecoleccion)
    {
        $this->metodosrecoleccion->removeElement($metodosrecoleccion);
    }

    /**
     * Get metodosrecoleccion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMetodosrecoleccion()
    {
        return $this->metodosrecoleccion;
    }

    public function hasCuestionarioOnMetodo()
    {
        $m = $this->getMetodosrecoleccion();
        $nombre = "";
        foreach ($m as $m1) {
            $nombre =  $m1->getNombre();
            if ( (strpos($nombre, "Encuesta") !== FALSE) || (strpos($nombre, "Entrevista") !== FALSE))
                return true;
        }
        return false;
    }
}