<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\IndGestion;
use chanpp\EvImBundle\Entity\Meta;
use chanpp\EvImBundle\Form\IndGestionType;

/**
 * IndGestion controller.
 *
 * @Route("/indgestion")
 */
class IndGestionController extends Controller
{
    /**
     * Lists all IndGestion entities.
     *
     * @Route("/", name="indgestion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        //Chequeamos que tenga al menos un rol (no puede acceder gente con el link de evaluacion)
        if(is_object($this->container->get('security.context')->getToken()->getUser()))
        {
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('chanppEvImBundle:IndGestion')->findAll();

            return array(
                'entities' => $entities,
            );
        }
            return $this->redirect($this->generateUrl('chanpp_index'));
    }

    /**
     * Creates a new IndGestion entity.
     *
     * @Route("/", name="indgestion_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:IndGestion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new IndGestion();

        $form = $this->createForm(new IndGestionType(), $entity);
        $form->bind($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            //Guardar metas asociadas

            //Asociar Ind Gestion a Ficha de Proyecto
            $ficha_proyecto = $entity->getFichaProyecto();
            $ficha_proyecto->addIndGestion($entity);
            $em->persist($ficha_proyecto);

            $em->flush();

            return $this->redirect($this->generateUrl('fichaproyecto_show', array('id' => $ficha_proyecto->getId())));
        }
        else
        {
            //DEBUG ONLI
            //return $form->getErrorsAsString();
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new IndGestion entity.
     *
     * @Route("/addIndgest", name="indgestion_create_add")
     * @Template("chanppEvImBundle:IndGestion:new.html.twig")
     */
    public function createAddAction(Request $request)
    {
        $entity  = new IndGestion();

        $form = $this->createForm(new IndGestionType(), $entity);
        $form->bind($request);
        $id_proyecto = 2;

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            //Guardar metas asociadas

            //Asociar Ind Gestion a Ficha de Proyecto
            $ficha_proyecto = $entity->getFichaProyecto();
            $id_proyecto = $ficha_proyecto->getId();
            $ficha_proyecto->addIndGestion($entity);
            $em->persist($ficha_proyecto);

            $em->flush();

            //return $this->redirect($this->generateUrl('fichaproyecto_show', array('id' => $ficha_proyecto->getId())));
        }
        else
        {
            //DEBUG ONLI
            //return $form->getErrorsAsString();
        }

        return $this->redirect($this->generateUrl('indgestion_new', array('ficha_proyecto_id' => $id_proyecto)));
    }

    /**
     * Displays a form to create a new IndGestion entity.
     *
     * @Route("/new/{ficha_proyecto_id}", name="indgestion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($ficha_proyecto_id)
    {
        $entity = new IndGestion();

        $meta = new Meta();
        $meta->setNombre('Meta 1');
        $entity->getMetas()->add($meta);

       // $ficha_proyecto_id = 3;//$this->getRequest()->getParameter('ficha_proyecto_id');

        $em = $this->getDoctrine()->getManager();
        $entity->setFichaProyecto($em->getRepository('chanppEvImBundle:FichaProyecto')->find($ficha_proyecto_id));
        
        $form   = $this->createForm(new IndGestionType(), $entity);

        $em->flush();

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a IndGestion entity.
     *
     * @Route("/{id}", name="indgestion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:IndGestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndGestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing IndGestion entity.
     *
     * @Route("/{id}/edit", name="indgestion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:IndGestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndGestion entity.');
        }

        $editForm = $this->createForm(new IndGestionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing IndGestion entity.
     *
     * @Route("/{id}", name="indgestion_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:IndGestion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:IndGestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndGestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new IndGestionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('indgestion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a IndGestion entity.
     *
     * @Route("/{id}", name="indgestion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:IndGestion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find IndGestion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('indgestion'));
    }

    /**
     * Creates a form to delete a IndGestion entity by id.
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
