<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\Cuestionario;
use chanpp\EvImBundle\Form\CuestionarioType;

/**
 * Cuestionario controller.
 *
 * @Route("/cuestionario")
 */
class CuestionarioController extends Controller
{
    /**
     * Lists all Cuestionario entities.
     *
     * @Route("/", name="cuestionario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:Cuestionario')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Cuestionario entity.
     *
     * @Route("/", name="cuestionario_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:Cuestionario:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Cuestionario();
        $form = $this->createForm(new CuestionarioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cuestionario_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Cuestionario entity.
     *
     * @Route("/new", name="cuestionario_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cuestionario();
        $form   = $this->createForm(new CuestionarioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cuestionario entity.
     *
     * @Route("/{id}", name="cuestionario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cuestionario entity.
     *
     * @Route("/{id}/edit", name="cuestionario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }

        $editForm = $this->createForm(new CuestionarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Cuestionario entity.
     *
     * @Route("/{id}", name="cuestionario_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:Cuestionario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CuestionarioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cuestionario_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Cuestionario entity.
     *
     * @Route("/{id}", name="cuestionario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cuestionario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cuestionario'));
    }

    /**
     * Creates a form to delete a Cuestionario entity by id.
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
