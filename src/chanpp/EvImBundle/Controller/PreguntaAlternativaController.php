<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\PreguntaAlternativa;
use chanpp\EvImBundle\Form\PreguntaAlternativaType;

/**
 * PreguntaAlternativa controller.
 *
 * @Route("/preguntaalternativa")
 */
class PreguntaAlternativaController extends Controller
{
    /**
     * Lists all PreguntaAlternativa entities.
     *
     * @Route("/", name="preguntaalternativa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:PreguntaAlternativa')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PreguntaAlternativa entity.
     *
     * @Route("/", name="preguntaalternativa_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:PreguntaAlternativa:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PreguntaAlternativa();
        $tipo = $request->query->get('pregunta_tipo');
        $form = $this->createForm(new PreguntaAlternativaType(), $entity);
        #$form = $this->createForm(new PreguntaAlternativaType(), $entity, array('attr' => array('tipo' => $tipo)));
        #Get parameters
        $cuestionarioid =  $request->query->get('cuestionario_id');
        #Get other variables from GET
        $preguntanumero=  $request->query->get('pregunta_numero'); 
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $cuestionario  = $em->getRepository('chanppEvImBundle:Cuestionario')->find($cuestionarioid);
            $cuestionario->addPreguntasalternativa($entity);
            $entity->setNumeropregunta($preguntanumero);
            $entity->addCuestionario($cuestionario);
            $entity->setTipo($tipo);
            #Now we save the correct alternatives according to the tipo
            if($tipo == 1)
            {
                $entity->setAlternativas(array('1' => 'Si', '2' => 'No',));
            }
            else if($tipo == 2)
            {
                $entity->setAlternativas(array('1' => '1', '2' => '2','3' => '3', '4' => '4', '5' => '5',));
            }
            else if($tipo == 3)
            {

            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('preguntaalternativa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PreguntaAlternativa entity.
     *
     * @Route("/new", name="preguntaalternativa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PreguntaAlternativa();
        $form   = $this->createForm(new PreguntaAlternativaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PreguntaAlternativa entity.
     *
     * @Route("/{id}", name="preguntaalternativa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PreguntaAlternativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PreguntaAlternativa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PreguntaAlternativa entity.
     *
     * @Route("/{id}/edit", name="preguntaalternativa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PreguntaAlternativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PreguntaAlternativa entity.');
        }

        $editForm = $this->createForm(new PreguntaAlternativaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PreguntaAlternativa entity.
     *
     * @Route("/{id}", name="preguntaalternativa_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:PreguntaAlternativa:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:PreguntaAlternativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PreguntaAlternativa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PreguntaAlternativaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('preguntaalternativa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PreguntaAlternativa entity.
     *
     * @Route("/{id}", name="preguntaalternativa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:PreguntaAlternativa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PreguntaAlternativa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('preguntaalternativa'));
    }

    /**
     * Creates a form to delete a PreguntaAlternativa entity by id.
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
