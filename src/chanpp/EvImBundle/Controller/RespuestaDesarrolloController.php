<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\RespuestaDesarrollo;
use chanpp\EvImBundle\Form\RespuestaDesarrolloType;

/**
 * RespuestaDesarrollo controller.
 *
 * @Route("/respuestadesarrollo")
 */
class RespuestaDesarrolloController extends Controller
{
    /**
     * Lists all RespuestaDesarrollo entities.
     *
     * @Route("/", name="respuestadesarrollo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:RespuestaDesarrollo')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new RespuestaDesarrollo entity.
     *
     * @Route("/", name="respuestadesarrollo_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:RespuestaDesarrollo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new RespuestaDesarrollo();
        $form = $this->createForm(new RespuestaDesarrolloType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuestadesarrollo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new RespuestaDesarrollo entity.
     *
     * @Route("/new", name="respuestadesarrollo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RespuestaDesarrollo();
        $form   = $this->createForm(new RespuestaDesarrolloType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a RespuestaDesarrollo entity.
     *
     * @Route("/{id}", name="respuestadesarrollo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:RespuestaDesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaDesarrollo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RespuestaDesarrollo entity.
     *
     * @Route("/{id}/edit", name="respuestadesarrollo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:RespuestaDesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaDesarrollo entity.');
        }

        $editForm = $this->createForm(new RespuestaDesarrolloType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing RespuestaDesarrollo entity.
     *
     * @Route("/{id}", name="respuestadesarrollo_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:RespuestaDesarrollo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:RespuestaDesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaDesarrollo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RespuestaDesarrolloType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuestadesarrollo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a RespuestaDesarrollo entity.
     *
     * @Route("/{id}", name="respuestadesarrollo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:RespuestaDesarrollo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RespuestaDesarrollo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('respuestadesarrollo'));
    }

    /**
     * Creates a form to delete a RespuestaDesarrollo entity by id.
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
