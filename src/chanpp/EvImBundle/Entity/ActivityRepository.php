<?php

namespace chanpp\EvImBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ActivityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActivityRepository extends EntityRepository
{

	public function findAllbyFichaProyecto($fichaproyecto)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM chanppEvImBundle:Activity a WHERE a.ficha_proyecto = :fichaproyecto')
            ->setParameter('fichaproyecto', $fichaproyecto)
            ->getResult();
    }

}
