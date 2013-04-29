<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\PlanEvaluacion;
use chanpp\EvImBundle\Form\PlanEvaluacionType;

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
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
        $entity = new PlanEvaluacion();
        $form   = $this->createForm(new PlanEvaluacionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
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

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanEvaluacion entity.');
        }

        $editForm = $this->createForm(new PlanEvaluacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanEvaluacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PlanEvaluacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planevaluacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PlanEvaluacion entity.
     *
     * @Route("/{id}", name="planevaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PlanEvaluacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('planevaluacion'));
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
}
