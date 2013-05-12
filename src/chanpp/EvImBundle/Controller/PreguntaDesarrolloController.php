<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\PreguntaDesarrollo;
use chanpp\EvImBundle\Form\PreguntaDesarrolloType;

/**
 * PreguntaDesarrollo controller.
 *
 * @Route("/preguntadesarrollo")
 */
class PreguntaDesarrolloController extends Controller
{
    /**
     * Lists all PreguntaDesarrollo entities.
     *
     * @Route("/", name="preguntadesarrollo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:PreguntaDesarrollo')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PreguntaDesarrollo entity.
     *
     * @Route("/", name="preguntadesarrollo_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:PreguntaDesarrollo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PreguntaDesarrollo();
        $form = $this->createForm(new PreguntaDesarrolloType(), $entity);
        #Get the cuestionario id
        $cuestionarioid =  $request->query->get('cuestionario_id');
        #Get other variables from GET
        $preguntanumero=  $request->query->get('pregunta_numero');
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($cuestionarioid == 0)
            {
                #We need to create a non-linked question, which is a repeating one
                $entity->setTipo(0);
                $entity->setNumeropregunta(0);
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('preguntadesarrollo_show', array('id' => $entity->getId())));
            } 
            else
            {

                $cuestionario  = $em->getRepository('chanppEvImBundle:Cuestionario')->find($cuestionarioid);
                if($cuestionario->getDone())
                {
                    return $this->redirect($this->generateUrl('cuestionario_show', array('id' => $cuestionarioid, 'error' => "Error : El cuestionario está cerrado y no se pueden agregar más preguntas.",)));
                }
                else
                {
                    $cuestionario->addPreguntasdesarrollo($entity);
                    $entity->setNumeropregunta($preguntanumero);
                    $entity->addCuestionario($cuestionario);
                    $em->persist($cuestionario);
                    $em->persist($entity);
                    $em->flush();
                    return $this->redirect($this->generateUrl('cuestionario_show', array('id' => $cuestionarioid)));
           
                }
            }

            
     }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PreguntaDesarrollo entity.
     *
     * @Route("/new", name="preguntadesarrollo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PreguntaDesarrollo();
        $form   = $this->createForm(new PreguntaDesarrolloType(), $entity);
         return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PreguntaDesarrollo entity.
     *
     * @Route("/{id}", name="preguntadesarrollo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PreguntaDesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PreguntaDesarrollo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PreguntaDesarrollo entity.
     *
     * @Route("/{id}/edit", name="preguntadesarrollo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PreguntaDesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PreguntaDesarrollo entity.');
        }

        $editForm = $this->createForm(new PreguntaDesarrolloType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PreguntaDesarrollo entity.
     *
     * @Route("/{id}", name="preguntadesarrollo_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:PreguntaDesarrollo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PreguntaDesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PreguntaDesarrollo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PreguntaDesarrolloType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('preguntadesarrollo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PreguntaDesarrollo entity.
     *
     * @Route("/{id}", name="preguntadesarrollo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:PreguntaDesarrollo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PreguntaDesarrollo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('preguntadesarrollo'));
    }

    /**
     * Creates a form to delete a PreguntaDesarrollo entity by id.
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
