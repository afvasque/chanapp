<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\Respuesta;
use chanpp\EvImBundle\Form\RespuestaType;

/**
 * Respuesta controller.
 *
 * @Route("/respuesta")
 */
class RespuestaController extends Controller
{
    /**
     * Lists all Respuesta entities.
     *
     * @Route("/", name="respuesta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:Respuesta')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Respuesta entity.
     *
     * @Route("/", name="respuesta_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:Respuesta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Respuesta();
        $form = $this->createForm(new RespuestaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuesta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Respuesta entity.
     *
     * @Route("/new", name="respuesta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Respuesta();
        $form   = $this->createForm(new RespuestaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Respuesta entity.
     *
     * @Route("/{id}", name="respuesta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Respuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Respuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Respuesta entity.
     *
     * @Route("/{id}/edit", name="respuesta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Respuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Respuesta entity.');
        }

        $editForm = $this->createForm(new RespuestaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Respuesta entity.
     *
     * @Route("/{id}", name="respuesta_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:Respuesta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Respuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Respuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RespuestaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuesta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Respuesta entity.
     *
     * @Route("/{id}", name="respuesta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:Respuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Respuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('respuesta'));
    }

    /**
     * Creates a form to delete a Respuesta entity by id.
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
