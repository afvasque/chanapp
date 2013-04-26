<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\FichaProyecto;
use chanpp\EvImBundle\Form\FichaProyectoType;

/**
 * FichaProyecto controller.
 *
 * @Route("/fichaproyecto")
 */
class FichaProyectoController extends Controller
{
    /**
     * Lists all FichaProyecto entities.
     *
     * @Route("/", name="fichaproyecto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:FichaProyecto')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new FichaProyecto entity.
     *
     * @Route("/", name="fichaproyecto_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:FichaProyecto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new FichaProyecto();
        $form = $this->createForm(new FichaProyectoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fichaproyecto_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new FichaProyecto entity.
     *
     * @Route("/new", name="fichaproyecto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new FichaProyecto();
        $form   = $this->createForm(new FichaProyectoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FichaProyecto entity.
     *
     * @Route("/{id}", name="fichaproyecto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FichaProyecto entity.
     *
     * @Route("/{id}/edit", name="fichaproyecto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
        }

        $editForm = $this->createForm(new FichaProyectoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing FichaProyecto entity.
     *
     * @Route("/{id}", name="fichaproyecto_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:FichaProyecto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FichaProyectoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fichaproyecto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a FichaProyecto entity.
     *
     * @Route("/{id}", name="fichaproyecto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fichaproyecto'));
    }

    /**
     * Creates a form to delete a FichaProyecto entity by id.
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
