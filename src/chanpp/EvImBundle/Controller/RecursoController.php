<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\Recurso;
use chanpp\EvImBundle\Form\RecursoType;
use chanpp\EvImBundle\Entity\PlanEvaluacion;
/**
 * Recurso controller.
 *
 * @Route("/recurso")
 */
class RecursoController extends Controller
{
    /**
     * Lists all Recurso entities.
     *
     * @Route("/", name="recurso")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:Recurso')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Recurso entity.
     *
     * @Route("/", name="recurso_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:Recurso:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Recurso();
        $form = $this->createForm(new RecursoType(), $entity);
        $planevaluacionid =  $request->query->get('planevaluacion_id');
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             #Get the PlanEvaluación and link it
            $plan  = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($planevaluacionid);
            $entity-> setPlanEvaluacion($plan);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planevaluacion_show', array('id' => $planevaluacionid)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Recurso entity.
     *
     * @Route("/new", name="recurso_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Recurso();
        $form   = $this->createForm(new RecursoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Recurso entity.
     *
     * @Route("/{id}", name="recurso_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Recurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recurso entity.');
        }
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Recurso entity.
     *
     * @Route("/{id}/edit", name="recurso_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Recurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recurso entity.');
        }

        $editForm = $this->createForm(new RecursoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Recurso entity.
     *
     * @Route("/{id}", name="recurso_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:Recurso:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Recurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RecursoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recurso_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Recurso entity.
     *
     * @Route("/{id}", name="recurso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:Recurso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recurso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recurso'));
    }

    /**
     * Creates a form to delete a Recurso entity by id.
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
