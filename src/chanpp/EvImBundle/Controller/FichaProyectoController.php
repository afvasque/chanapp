<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\FichaProyecto;
use chanpp\EvImBundle\Entity\Activity;
use chanpp\EvImBundle\Entity\IndGestion;
use chanpp\EvImBundle\Form\FichaProyectoType;

/**
 * FichaProyecto controller.
 *
 * @Route("/fichaproyecto")
 */
class FichaProyectoController extends Controller
{
    /**
     * Lists all FichaProyecto entities.
     *
     * @Route("/", name="fichaproyecto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chanppEvImBundle:FichaProyecto')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new FichaProyecto entity.
     *
     * @Route("/", name="fichaproyecto_create")
     * @Method("POST")
     * @Template("chanppEvImBundle:FichaProyecto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
		$roles = $user->getRoles();
        if($roles[0] == "ROLE_SUPER_ADMIN" or $roles[0] == "ROLE_PLANIFICADOR")
        {
            $entity  = new FichaProyecto();
            $form = $this->createForm(new FichaProyectoType(), $entity);
            $form->bind($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();            
                $em->persist($entity);
                $em->flush();
               
                return $this->forward('chanppEvImBundle:IndGestion:new',
                    array('ficha_proyecto_id' => $entity->getId()));

                //return $this->redirect($this->generateUrl('fichaproyecto_show', array('id' => $entity->getId())));
            } else        {
                /**
                 * @var \Symfony\Component\Form\FormError $error
                 */
                foreach ($form->getErrors() as $key => $error) {
                    $errors[] = $error->getMessage();
                }
            }
        } else
        {
            return $this->redirect($this->generateUrl('fichaproyecto'));
        }            
        
    
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );

    }

    /**
     * Displays a form to create a new FichaProyecto entity.
     *
     * @Route("/new", name="fichaproyecto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $roles = $user->getRoles();
        if($roles[0] == "ROLE_SUPER_ADMIN" or $roles[0] == "ROLE_PLANIFICADOR")
        {
            $entity = new FichaProyecto();

            $activity = new Activity();
            $activity->setNombre("acitividad");
            $entity->getActivities()->add($activity);

            $indGestion = new IndGestion();
            $entity->getIndGestions()->add($indGestion);

            $form   = $this->createForm(new FichaProyectoType(), $entity);
        }
        else
        {
            return $this->redirect($this->generateUrl('fichaproyecto'));
        }

    
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FichaProyecto entity.
     *
     * @Route("/{id}", name="fichaproyecto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
        }
        $planevaluaciones =  $entity->getPlanevaluaciones();
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'planevaluaciones' => $planevaluaciones,
        );
    }

    /**
     * Displays a form to edit an existing FichaProyecto entity.
     *
     * @Route("/{id}/edit", name="fichaproyecto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
		$roles = $user->getRoles();
        if($roles[0] == "ROLE_SUPER_ADMIN")
        {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
            }

            $editForm = $this->createForm(new FichaProyectoType(), $entity);
            $deleteForm = $this->createDeleteForm($id);

            return array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            );
        } else
        {
			$roles = $user->getRoles();
            return $roles[0];
            //return $this->redirect($this->generateUrl('fichaproyecto_show', array('id' => $id)));
        }
    }


    /**
     * Edits an existing FichaProyecto entity.
     *
     * @Route("/{id}", name="fichaproyecto_update")
     * @Method("PUT")
     * @Template("chanppEvImBundle:FichaProyecto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FichaProyectoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {

           $originalTags = array();

            // Create an array of the current Tag objects in the database
            foreach ($entity->getActivities() as $tag) {
                $originalTags[] = $tag;
            }


            // filter $originalTags to contain tags no longer present
            foreach ($entity->getActivities() as $tag) {
                foreach ($originalTags as $key => $toDel) {
                    if ($toDel->getId() === $tag->getId()) {
                        unset($originalTags[$key]);
                    }
                }
            }

            // remove the relationship between the tag and the Task
            foreach ($originalTags as $tag) {
                // remove the Task from the Tag
                //$tag->getTasks()->removeElement($task);

                // if it were a ManyToOne relationship, remove the relationship like this
                 $tag->setFichaProyecto(null);

                $em->persist($tag);

                // if you wanted to delete the Tag entirely, you can also do that
                $em->remove($tag);
            }

            $entity->setNombreEditor($this->container->get('security.context')->getToken()->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fichaproyecto_show', array('id' => $id)));
        }
        else
        {
            return $form->getErrorsAsString();
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a FichaProyecto entity.
     *
     * @Route("/{id}", name="fichaproyecto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chanppEvImBundle:FichaProyecto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FichaProyecto entity.');
            }

            


            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fichaproyecto'));
    }

    /**
     * Creates a form to delete a FichaProyecto entity by id.
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
