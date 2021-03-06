<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\EvaluacionIndirecta;
use chanpp\EvImBundle\Form\EvaluacionIndirectaType;
use chanpp\EvImBundle\Entity\Evaluacion;
use chanpp\EvImBundle\Entity\Document;
/**
 * EvaluacionIndirecta controller.
 *
 * @Route("/evaluacionindirecta")
 */
class EvaluacionIndirectaController extends Controller
{
    /**
     * Lists all EvaluacionIndirecta entities.
     *
     * @Route("/", name="evaluacionindirecta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:EvaluacionIndirecta')->findAll();

        return array(
            'entities' => $entities,
        );
    }


    /**
     * Get cuetionario for entity
     *
     * @Route("/{id}/results", name="evaluacionindirecta_results")
     * @Method("GET")
     * @Template()
     */
    public function showResultsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:EvaluacionIndirecta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluacionIndirecta entity.');
        }

        return array(
            'entity'      => $entity,
            );
    }

    /**
     * Creates a new EvaluacionIndirecta entity.
     *
     * @Route("/", name="evaluacionindirecta_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:EvaluacionIndirecta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new EvaluacionIndirecta();
        $form = $this->createForm(new EvaluacionIndirectaType(), $entity);
        $evaluacionid =  $request->query->get('evaluacion_id');
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             #Get the Evaluación and link it
            $evaluacion  = $em->getRepository('chanppEvImBundle:Evaluacion')->find($evaluacionid);
            if($evaluacion->getDone())
            {
                 return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $evaluacionid, 'error' => 'La evaluación padre ya ha sido cerrada, por lo que no se pueden agregar sub-evaluaciones.')));
            }
            $entity-> setEvaluacion($evaluacion);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluacionindirecta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new EvaluacionIndirecta entity.
     *
     * @Route("/new", name="evaluacionindirecta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EvaluacionIndirecta();
        $form   = $this->createForm(new EvaluacionIndirectaType(), $entity);
        $em = $this->getDoctrine()->getManager();

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EvaluacionIndirecta entity.
     *
     * @Route("/{id}", name="evaluacionindirecta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:EvaluacionIndirecta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluacionIndirecta entity.');
        }
        $document  = $entity->getDocument();
        $deleteForm = $this->createDeleteForm($id);
        $metodos = $entity->getMetodosrecoleccion();
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'document' => $document,
            'metodos' => $metodos,
        );
    }

    /**
     * Displays a form to edit an existing EvaluacionIndirecta entity.
     *
     * @Route("/{id}/edit", name="evaluacionindirecta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:EvaluacionIndirecta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluacionIndirecta entity.');
        }

        $editForm = $this->createForm(new EvaluacionIndirectaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EvaluacionIndirecta entity.
     *
     * @Route("/{id}", name="evaluacionindirecta_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:EvaluacionIndirecta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:EvaluacionIndirecta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EvaluacionIndirecta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EvaluacionIndirectaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            if($entity->getEvaluacion()->getDone())
            {
                 return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $entity->getEvaluacion()->getId(), 'error' => 'La evaluación padre ya ha sido cerrada, por lo que no se pueden agregar sub-evaluaciones.')));
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluacionindirecta_show', array('id' => $entity->getId() )));

        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EvaluacionIndirecta entity.
     *
     * @Route("/{id}", name="evaluacionindirecta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);
        $evaluacionid = 0;
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:EvaluacionIndirecta')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EvaluacionIndirecta entity.');
            }
            
            if($entity->getEvaluacion()->getDone())
            {
                 return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $entity->getEvaluacion()->getId(), 'error' => 'La evaluación padre ya ha sido cerrada, por lo que no se pueden agregar sub-evaluaciones.')));
            }
            if($entity->getDocument())
            {
                $document = $em->getRepository('chanppEvImBundle:Document')->find($entity->getDocument()->getId());
                $entity->setDocument(null);
                $em->remove($document);
            }
            $evaluacionid = $entity->getEvaluacion()->getId();
            $entity->getEvaluacion()->removeEvaluacionesindirecta($entity);
            #Delete cuestionario
            $em->remove($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $evaluacionid)));
    }

    /**
     * Creates a form to delete a EvaluacionIndirecta entity by id.
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

    public function uploadAction(Request $request)
    {
      
        $document = new Document();
        $form = $this->createFormBuilder($document)
            ->add('file','file', array('label' => 'Archivo'))
            ->getForm();
        $evaluacionid =  $request->query->get('evaluacionindirecta_id');
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
             #Get the Evaluación and link it
            $evaluacion  = $em->getRepository('chanppEvImBundle:EvaluacionIndirecta')->find($evaluacionid);
             #Donecheck
            if($evaluacion->getEvaluacion()->getDone())
            {
                 return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $entity->getEvaluacion()->getId(), 'error' => 'La evaluación padre ya ha sido cerrada, por lo que no se pueden agregar sub-evaluaciones.')));
            }
             #First we check that the current EvaluacionIndirecta doesn't have any files
            if(($evaluacion->getDocument()))
            {
               #We edit it
                $olddocument = $evaluacion->getDocument();
                $olddocument->setFile($document->getFile());
                $em->persist($olddocument);
                $em->flush(); 
            }
            else
            {
               #New one  
               $document-> setEvaluacionindirecta($evaluacion);
               $em->persist($document);
               $em->flush();   
            }

            return $this->redirect($this->generateUrl('evaluacionindirecta_show', array('id' => $evaluacionid)));
        }
        return $this->render(
    "chanppEvImBundle:EvaluacionIndirecta:upload.html.twig",
        array('form' => $form->createView()) );
    }
   
}
