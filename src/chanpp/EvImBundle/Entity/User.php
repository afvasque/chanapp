<?php

namespace chanpp\EvImBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


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
     * Set nombre:string(255)
     *
     * @param string $nombre:string(255)
     * @return User
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre:string(255)
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

     /**
     * Get Role
     *
     * @return string 
     */
    public function getRole()
    {
        if($this->roles[0]=="ROLE_SUPER_ADMIN")
            return "Administrador";
        elseif ($this->roles[0]=="ROLE_PLANIFICADOR") 
            return "Planificador";
        elseif ($this->roles[0]=="ROLE_EVALUADOR") 
            return 'Evaluador';
        elseif($this->roles[0]=="ROLE_EVALUADOR")
            return 'Visita';
    }

}
