<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\Evaluacion;
use chanpp\EvImBundle\Form\EvaluacionType;
use chanpp\EvImBundle\Entity\PlanEvaluacion;
/**
 * Evaluacion controller.
 *
 * @Route("/evaluacion")
 */
class EvaluacionController extends Controller
{
    /**
     * Lists all Evaluacion entities.
     *
     * @Route("/", name="evaluacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:Evaluacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Evaluacion entity.
     *
     * @Route("/", name="evaluacion_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:Evaluacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Evaluacion();
        $form = $this->createForm(new EvaluacionType(), $entity);
        $planevaluacionid =  $request->query->get('planevaluacion_id');
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             #Get the PlanEvaluación and link it
            $plan  = $em->getRepository('chanppEvImBundle:PlanEvaluacion')->find($planevaluacionid);
            $entity-> setPlanevaluacion($plan);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Evaluacion entity.
     *
     * @Route("/new", name="evaluacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Evaluacion();
        $form   = $this->createForm(new EvaluacionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Evaluacion entity.
     *
     * @Route("/{id}", name="evaluacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chanppEvImBundle:Evaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluacion entity.');
        }
        $evaluaciondirecta =  $entity->getEvaluaciondirecta();
        $evaluacionesindirectas = $entity->getEvaluacionesindirectas();
        $deleteForm = $this->createDeleteForm($id);
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'evaluaciondirecta' => $evaluaciondirecta,
            'evaluacionesindirectas' => $evaluacionesindirectas,
        );
    }

    /**
     * Displays a form to edit an existing Evaluacion entity.
     *
     * @Route("/{id}/edit", name="evaluacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Evaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluacion entity.');
        }

        $editForm = $this->createForm(new EvaluacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Evaluacion entity.
     *
     * @Route("/{id}", name="evaluacion_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:Evaluacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Evaluacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evaluacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EvaluacionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Evaluacion entity.
     *
     * @Route("/{id}", name="evaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:Evaluacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evaluacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evaluacion'));
    }

    /**
     * Creates a form to delete a Evaluacion entity by id.
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
