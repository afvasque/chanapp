<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\FichaProyecto;

class IndexController extends Controller
{
	 /**
     * Pagina de inciio
     *
     * @Route("/pagina", name="index_show")
     * @Method("GET")
     * @Template("chanppEvImBundle:Index:index.html.twig")
     */
    public function indexAction()
    {
        return array(
            'entities' => "hola",
        );
    }

    /**
     * Finds and displays a FichaProyecto entity.
     *
     * @Route("/pagina/resultados", name="resultados_all_show")
     * @Method("GET")
     * @Template()
     */
    public function showResultadosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:FichaProyecto')->findAll();

        return array(
            'ficha_proyectos' => $entities,
        );
    }
}