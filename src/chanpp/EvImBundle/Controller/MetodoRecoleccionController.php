<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\MetodoRecoleccion;
use chanpp\EvImBundle\Form\MetodoRecoleccionType;

/**
 * MetodoRecoleccion controller.
 *
 * @Route("/metodorecoleccion")
 */
class MetodoRecoleccionController extends Controller
{
    /**
     * Lists all MetodoRecoleccion entities.
     *
     * @Route("/", name="metodorecoleccion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:MetodoRecoleccion')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new MetodoRecoleccion entity.
     *
     * @Route("/", name="metodorecoleccion_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:MetodoRecoleccion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new MetodoRecoleccion();
        $form = $this->createForm(new MetodoRecoleccionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $original_redirect=  $request->query->get('original_redirect');
            $original_id=  $request->query->get('original_id');
            return $this->redirect($this->generateUrl('metodorecoleccion', array('original_redirect' => $original_redirect, 'original_id' => $original_id)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new MetodoRecoleccion entity.
     *
     * @Route("/new", name="metodorecoleccion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MetodoRecoleccion();
        $form   = $this->createForm(new MetodoRecoleccionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MetodoRecoleccion entity.
     *
     * @Route("/{id}", name="metodorecoleccion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:MetodoRecoleccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MetodoRecoleccion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MetodoRecoleccion entity.
     *
     * @Route("/{id}/edit", name="metodorecoleccion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:MetodoRecoleccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MetodoRecoleccion entity.');
        }

        $editForm = $this->createForm(new MetodoRecoleccionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing MetodoRecoleccion entity.
     *
     * @Route("/{id}", name="metodorecoleccion_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:MetodoRecoleccion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:MetodoRecoleccion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MetodoRecoleccion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MetodoRecoleccionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $original_redirect=  $request->query->get('original_redirect');
            $original_id=  $request->query->get('original_id');
            return $this->redirect($this->generateUrl('metodorecoleccion', array('original_redirect' => $original_redirect, 'original_id' => $original_id)));
        
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a MetodoRecoleccion entity.
     *
     * @Route("/{id}", name="metodorecoleccion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        return $this->redirect($this->generateUrl('chanpp_index'));
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:MetodoRecoleccion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MetodoRecoleccion entity.');
            }
            #Clear the EvaluacionesIndirectas
            $eindi = $entity->getEvaluacionesindirectas();
            if($eindi)
            {
               foreach($eindi as $e) {
                $entity->removeEvaluacionesindirecta($e);
                 } 
            }
            
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('metodorecoleccion'));
    }

    /**
     * Creates a form to delete a MetodoRecoleccion entity by id.
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
