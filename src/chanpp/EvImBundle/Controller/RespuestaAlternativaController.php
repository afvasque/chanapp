<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\RespuestaAlternativa;
use chanpp\EvImBundle\Form\RespuestaAlternativaType;

/**
 * RespuestaAlternativa controller.
 *
 * @Route("/respuestaalternativa")
 */
class RespuestaAlternativaController extends Controller
{
    /**
     * Lists all RespuestaAlternativa entities.
     *
     * @Route("/", name="respuestaalternativa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:RespuestaAlternativa')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new RespuestaAlternativa entity.
     *
     * @Route("/", name="respuestaalternativa_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:RespuestaAlternativa:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new RespuestaAlternativa();
        $form = $this->createForm(new RespuestaAlternativaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuestaalternativa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new RespuestaAlternativa entity.
     *
     * @Route("/new", name="respuestaalternativa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RespuestaAlternativa();
        $form   = $this->createForm(new RespuestaAlternativaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a RespuestaAlternativa entity.
     *
     * @Route("/{id}", name="respuestaalternativa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:RespuestaAlternativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaAlternativa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RespuestaAlternativa entity.
     *
     * @Route("/{id}/edit", name="respuestaalternativa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:RespuestaAlternativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaAlternativa entity.');
        }

        $editForm = $this->createForm(new RespuestaAlternativaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing RespuestaAlternativa entity.
     *
     * @Route("/{id}", name="respuestaalternativa_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:RespuestaAlternativa:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:RespuestaAlternativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaAlternativa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RespuestaAlternativaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuestaalternativa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a RespuestaAlternativa entity.
     *
     * @Route("/{id}", name="respuestaalternativa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:RespuestaAlternativa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RespuestaAlternativa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('respuestaalternativa'));
    }

    /**
     * Creates a form to delete a RespuestaAlternativa entity by id.
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
