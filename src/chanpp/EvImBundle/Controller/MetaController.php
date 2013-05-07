<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\Meta;
use chanpp\EvImBundle\Form\MetaType;

/**
 * Meta controller.
 *
 * @Route("/meta")
 */
class MetaController extends Controller
{
    /**
     * Lists all Meta entities.
     *
     * @Route("/", name="meta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:Meta')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Meta entity.
     *
     * @Route("/", name="meta_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:Meta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Meta();
        $form = $this->createForm(new MetaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('meta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Meta entity.
     *
     * @Route("/new", name="meta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Meta();
        $form   = $this->createForm(new MetaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Meta entity.
     *
     * @Route("/{id}", name="meta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Meta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Meta entity.
     *
     * @Route("/{id}/edit", name="meta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Meta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meta entity.');
        }

        $editForm = $this->createForm(new MetaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Meta entity.
     *
     * @Route("/{id}", name="meta_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:Meta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Meta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MetaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('meta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Meta entity.
     *
     * @Route("/{id}", name="meta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:Meta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('meta'));
    }

    /**
     * Creates a form to delete a Meta entity by id.
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
