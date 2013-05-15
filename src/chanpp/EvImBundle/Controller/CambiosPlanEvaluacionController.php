<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\CambiosPlanEvaluacion;
use chanpp\EvImBundle\Form\CambiosPlanEvaluacionType;

/**
 * CambiosPlanEvaluacion controller.
 *
 * @Route("/cambiosplanevaluacion")
 */
class CambiosPlanEvaluacionController extends Controller
{
    /**
     * Lists all CambiosPlanEvaluacion entities.
     *
     * @Route("/", name="cambiosplanevaluacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:CambiosPlanEvaluacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new CambiosPlanEvaluacion entity.
     *
     * @Route("/", name="cambiosplanevaluacion_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:CambiosPlanEvaluacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new CambiosPlanEvaluacion();
        $form = $this->createForm(new CambiosPlanEvaluacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cambiosplanevaluacion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new CambiosPlanEvaluacion entity.
     *
     * @Route("/new", name="cambiosplanevaluacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $roles = $user->getRoles();
        if($roles[0] == "ROLE_SUPER_ADMIN" or $roles[0] == "ROLE_ADMIN" or $roles[0] == "ROLE_PLANIFICADOR")
        {
            $entity = new CambiosPlanEvaluacion();
            $form   = $this->createForm(new CambiosPlanEvaluacionType(), $entity);

            return array(
                'entity' => $entity,
                'form'   => $form->createView(),
            );
        }
        else{ return $this->redirect($this->generateUrl('planevaluacion'));}
    }

    /**
     * Finds and displays a CambiosPlanEvaluacion entity.
     *
     * @Route("/{id}", name="cambiosplanevaluacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        #Instead of showing a specific Cambio, we show all the cambios for a plan with id $id
        $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);
        $cambios = $entity->getCambios();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanEvaluacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'cambios' => $cambios,
        );
    }

    /**
     * Displays a form to edit an existing CambiosPlanEvaluacion entity.
     *
     * @Route("/{id}/edit", name="cambiosplanevaluacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        if($roles[0] == "ROLE_SUPER_ADMIN" or $roles[0] == "ROLE_ADMIN" or $roles[0] == "ROLE_PLANIFICADOR")
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('chanppEvImBundle:CambiosPlanEvaluacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CambiosPlanEvaluacion entity.');
            }

            $editForm = $this->createForm(new CambiosPlanEvaluacionType(), $entity);
            $deleteForm = $this->createDeleteForm($id);

            return array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        }
        else
        {
            return $this->redirect($this->generateUrl('planevaluacion'));
        }
    }

    /**
     * Edits an existing CambiosPlanEvaluacion entity.
     *
     * @Route("/{id}", name="cambiosplanevaluacion_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:CambiosPlanEvaluacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:CambiosPlanEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CambiosPlanEvaluacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CambiosPlanEvaluacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cambiosplanevaluacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a CambiosPlanEvaluacion entity.
     *
     * @Route("/{id}", name="cambiosplanevaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:CambiosPlanEvaluacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CambiosPlanEvaluacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cambiosplanevaluacion'));
    }

    /**
     * Creates a form to delete a CambiosPlanEvaluacion entity by id.
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
}
