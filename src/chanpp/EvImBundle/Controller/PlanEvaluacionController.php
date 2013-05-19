<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\PlanEvaluacion;
use chanpp\EvImBundle\Form\PlanEvaluacionType;
use chanpp\EvImBundle\Entity\FichaProyecto;
use chanpp\EvImBundle\Entity\CambiosPlanEvaluacion;
/**
 * PlanEvaluacion controller.
 *
 * @Route("/planevaluacion")
 */
class PlanEvaluacionController extends Controller
{
    /**
     * Lists all PlanEvaluacion entities.
     *
     * @Route("/", name="planevaluacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->findAll();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PlanEvaluacion entity.
     *
     * @Route("/", name="planevaluacion_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:PlanEvaluacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PlanEvaluacion();
        $form = $this->createForm(new PlanEvaluacionType(), $entity);
        $fichaproyectoid =  $request->query->get('fichaproyecto_id');
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             #Get the FichaProyecto and link it
            $ficha  = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($fichaproyectoid);
            #If the ficha already has a PlanEvaluación, redirect to showficha
            if(count($ficha->getPlanevaluaciones()) >= 1) 
            {
                return $this->redirect($this->generateUrl('fichaproyecto_show', array('id' => $ficha->getId())));
            }
            $entity-> setFichaproyecto($ficha);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planevaluacion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PlanEvaluacion entity.
     *
     * @Route("/new", name="planevaluacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $roles = $user->getRoles();
        if($roles[0] == "ROLE_SUPER_ADMIN" or $roles[0] == "ROLE_ADMIN" or $roles[0] == "ROLE_PLANIFICADOR")
        {
            $entity = new PlanEvaluacion();
            $form   = $this->createForm(new PlanEvaluacionType(), $entity);
            return array(
                'entity' => $entity,
                'form'   => $form->createView(),
            );
        }
        return $this->redirect($this->generateUrl('fichaproyecto'));
    }

    /**
     * Finds and displays a PlanEvaluacion entity.
     *
     * @Route("/{id}", name="planevaluacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanEvaluacion entity.');
        }
        $recursos =  $entity->getRecursos();
        $evaluaciones = $entity->getEvaluaciones();
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'recursos' => $recursos,
            'evaluaciones' => $evaluaciones,
        );
    }

    /**
     * Displays a form to edit an existing PlanEvaluacion entity.
     *
     * @Route("/{id}/edit", name="planevaluacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $roles = $user->getRoles();
        if($roles[0] == "ROLE_SUPER_ADMIN" or $roles[0] == "ROLE_ADMIN" or $roles[0] == "ROLE_PLANIFICADOR")
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PlanEvaluacion entity.');
            }

            $editForm = $this->createForm(new PlanEvaluacionType(), $entity);
            $deleteForm = $this->createDeleteForm($id);

            return array(
                'entity'      => $entity,
                'form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        }
        return $this->redirect($this->generateUrl('fichaproyecto'));

    }

    /**
     * Edits an existing PlanEvaluacion entity.
     *
     * @Route("/{id}", name="planevaluacion_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:PlanEvaluacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $roles = $user->getRoles();
        if($roles[0] == "ROLE_SUPER_ADMIN" or $roles[0] == "ROLE_ADMIN" or $roles[0] == "ROLE_PLANIFICADOR")
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PlanEvaluacion entity.');
            }

            $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createForm(new PlanEvaluacionType(), $entity);
            $editForm->bind($request);

            if ($editForm->isValid()) {
                #We store the changes made
                $comentario = $request->get('comentarioedit');
                $cambio = new CambiosPlanEvaluacion();
                $cambio->setComentario($comentario);
                $cambio->setPlanevaluacion($entity);
                $name = $this->container->get('security.context')->getToken()->getUser();
                $cambio->setUsername($name);
                $cambio->setFechahoracambio(new \DateTime(date('Y-m-d H:i:s')));
                $entity->addCambio($cambio);
                $em->persist($cambio);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('planevaluacion_show', array('id' => $id)));
            }

            return array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        }
        return $this->redirect($this->generateUrl('fichaproyecto'));
    }

    /**
     * Deletes a PlanEvaluacion entity.
     *
     * @Route("/{id}", name="planevaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        #Can't be deleted, just editted
        return $this->redirect($this->generateUrl('planevaluacion_show', array('id' => $id)));
    }

    /**
     * Creates a form to delete a PlanEvaluacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Muestra tabla comparativa de resultados de todas las evauaciones de este plan.
     *
     * @Route("/{id}/resultados", name="planevaluacion_resultados_show")
     * @Method("GET")
     * @Template()
     */
    public function showResultadosAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);
               
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluacion entity.');
        }

        # Computar resultados varios

        # Desplegar resultados
        return array(
            'entity'      => $entity,
            'proyecto' => $entity->getFichaproyecto(),
        );

    }
}
