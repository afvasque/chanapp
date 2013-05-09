<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\EvaluacionDirecta;
use chanpp\EvImBundle\Form\EvaluacionDirectaType;
use chanpp\EvImBundle\Entity\Evaluacion;
use chanpp\EvImBundle\Entity\Document;
/**
 * EvaluacionDirecta controller.
 *
 * @Route("/evaluaciondirecta")
 */
class EvaluacionDirectaController extends Controller
{
    /**
     * Lists all EvaluacionDirecta entities.
     *
     * @Route("/", name="evaluaciondirecta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:EvaluacionDirecta')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new EvaluacionDirecta entity.
     *
     * @Route("/", name="evaluaciondirecta_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:EvaluacionDirecta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new EvaluacionDirecta();
        $form = $this->createForm(new EvaluacionDirectaType(), $entity);
        $evaluacionid =  $request->query->get('evaluacion_id');
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             #Get the Evaluación and link it
            $evaluacion  = $em->getRepository('chanppEvImBundle:Evaluacion')->find($evaluacionid);
            #Check that this evaluación doesn't have any other evaluacióndirecta
            if($evaluacion->getEvaluaciondirecta())
            {
                #Throw error
                return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $evaluacionid, 'error' => '1')));
            }
            else
            {
                $entity-> setEvaluacion($evaluacion);
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('evaluaciondirecta_show', array('id' => $entity->getId())));
            }  
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new EvaluacionDirecta entity.
     *
     * @Route("/new", name="evaluaciondirecta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EvaluacionDirecta();
        $form   = $this->createForm(new EvaluacionDirectaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EvaluacionDirecta entity.
     *
     * @Route("/{id}", name="evaluaciondirecta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:EvaluacionDirecta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluacionDirecta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EvaluacionDirecta entity.
     *
     * @Route("/{id}/edit", name="evaluaciondirecta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:EvaluacionDirecta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluacionDirecta entity.');
        }

        $editForm = $this->createForm(new EvaluacionDirectaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EvaluacionDirecta entity.
     *
     * @Route("/{id}", name="evaluaciondirecta_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:EvaluacionDirecta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:EvaluacionDirecta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluacionDirecta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EvaluacionDirectaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluaciondirecta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EvaluacionDirecta entity.
     *
     * @Route("/{id}", name="evaluaciondirecta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:EvaluacionDirecta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EvaluacionDirecta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evaluaciondirecta'));
    }

    /**
     * Creates a form to delete a EvaluacionDirecta entity by id.
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
