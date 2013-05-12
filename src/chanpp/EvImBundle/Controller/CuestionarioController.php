<?php

namespace chanpp\EvImBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chanpp\EvImBundle\Entity\Cuestionario;
use chanpp\EvImBundle\Form\CuestionarioType;
use Doctrine\Common\Collections\ArrayCollection;
use chanpp\EvImBundle\Entity\Respuesta;
use chanpp\EvImBundle\Entity\RespuestaDesarrollo;
use chanpp\EvImBundle\Entity\RespuestaAlternativa;
use chanpp\EvImBundle\Entity\PreguntaAlternativa;
use chanpp\EvImBundle\Entity\PreguntaDesarrollo;
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
        #We get the current question number (which means, the number the next question will have)
        $question_number = count($entity->getPreguntasdesarrollo()) + count($entity->getPreguntasalternativa()) +1;
        $preguntasdesarrollo = $entity->getPreguntasdesarrollo();
        $preguntasalternativa = $entity->getPreguntasalternativa();
        $respuestas = $entity->getRespuestas();
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'pregunta_numero' => $question_number,
            'preguntasdesarrollo' => $preguntasdesarrollo,
            'preguntasalternativa' => $preguntasalternativa,
            'respuestas' => $respuestas,
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


    /**
     * Displays the preview of a Cuestionario.
     *
     * @Route("/{id}", name="cuestionario_preview")
     * @Method("GET")
     * @Template()
     */
    public function  previewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }
        #We get all the questions
        $preguntas = $entity->getPreguntasSorted();
        $deleteForm = $this->createDeleteForm($id);
        #We get the current question number (which means, the number the next question will have)
        #Error
        $error = "";
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'preguntas' => $preguntas,
            'error' => $error
        );
    }

    /**
     * Displays the form to answer a Cuestionario.
     *
     * @Route("/{id}", name="cuestionario_answer")
     * @Method("GET")
     * @Template()
     */
    public function  answerAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }
        #We get all the questions
        $preguntas = $entity->getPreguntasSorted();
        $deleteForm = $this->createDeleteForm($id);
        return array(
            'entity'      => $entity,
            'form' => $deleteForm->createView(),
            'preguntas' => $preguntas,
        );
    }

     public function save_answersAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);
        $preguntas = $entity->getPreguntasSorted();
        $temprespuesta = new Respuesta();

        #Set values for Respuesta
        $nombre = $answer = $request->get('nombre');
        $empresa = $answer = $request->get('empresa');
        $mail = $answer = $request->get('mail');
        $telefono = $answer = $request->get('telefono');
        $respuestacheckemail = $entity->getRespuestas();
        #Check that the email is not repeated
         foreach($respuestacheckemail as  &$r)
        {
            if(strcmp($r->getMail(), $mail) == 0)
            {
                #Email already exists
                $result = "Error: Ya hay una respuesta con ese email.";
                return $this->render(
            "chanppEvImBundle:Cuestionario:save_answers.html.twig",
                array('answer1' => $result, 'cuestionario'=>$entity));
            } 
        }
        $temprespuesta->setNombre($nombre);
        $temprespuesta->setEmpresa($empresa);
        $temprespuesta->setMail($mail);
        $temprespuesta->setTelefono($telefono);
        #For each question, we create the appropiate answer and save it
        $counter = 0;
         foreach($preguntas as  &$p)
        {   
            $counter++;
            $answer = $request->get('respuesta')[$counter];
            if($p->getTipo() == 0)
            {

                $temprespuesta2 = new RespuestaDesarrollo();
                $temprespuesta2->setRespuesta($answer);
                $temprespuesta2->setPregunta($p);
                $temprespuesta2->setRespuestaParent($temprespuesta);
                $em->persist($temprespuesta2);
                $temprespuesta->getRespuestasdesarrollos()[] = $temprespuesta2;
            }
            else #Any PreguntaAlternativa is saved the same way
            {
                #Prevent fake answers
                if(intval($answer)<0 || ($p->getTipo() == 1 && intval($answer)>=3) || ($p->getTipo() == 2 && intval($answer)>=6))
                {
                    $result = "Error: Se ha intentado modificar alguno de los valores del cuestionario. Por favor intente de nuevo.";
                return $this->render(
            "chanppEvImBundle:Cuestionario:save_answers.html.twig",
                array('answer1' => $result, 'cuestionario'=>$entity));
                }
                $temprespuesta2 = new RespuestaAlternativa();
                $temprespuesta2->setRespuesta(intval($answer));
                $temprespuesta2->setPregunta($p);
                $temprespuesta2->setRespuestaParent($temprespuesta);
                $em->persist($temprespuesta2);
                $temprespuesta->getRespuestasalternativas()[] = $temprespuesta2;
            }
            
        }
        #Persist EVERYTHING
        $temprespuesta->setCuestionario($entity);
        $em->persist($temprespuesta);
        $entity->getRespuestas()[] = $temprespuesta;
        $em->persist($entity);
        $em->flush();
        $result = "El cuestionario ha sido guardado con éxito.";
        return $this->render(
    "chanppEvImBundle:Cuestionario:save_answers.html.twig",
        array('answer1' => $result, 'cuestionario'=>$entity));
    }

     public function change_orderAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);
        $preguntas = $entity->getPreguntasSorted();
        #Check that there are no duplicate values
        $orden = $request->get('orden');
        if(count($orden) == count(array_unique($orden)))
        {
            #No dupes
            $counter = 0;
            foreach($preguntas as  $p)
            {
                $counter++;
                $p->setNumeropregunta($orden[$counter]);
                $em->persist($p);
            }
            $em->persist($entity);
            $em->flush();
            return $this->render(
            "chanppEvImBundle:Cuestionario:preview.html.twig",
                array('error' => "Orden de preguntas actualizado con éxito", 'cuestionario'=>$entity));
        }   
        else
        {
            #Dupes
            return $this->render(
            "chanppEvImBundle:Cuestionario:preview.html.twig",
                array('error' => "Error: Más de una pregunta tiene el mismo número.", 'cuestionario'=>$entity));

        }
    }

    public function markasdoneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }
        $entity->setDone(true);
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('cuestionario_show', array('id' => $entity->getId())));
    }

     public function alternativa_linkAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }

        $editForm = $this->createForm(new CuestionarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $preguntas = $em->getRepository('chanppEvImBundle:PreguntaAlternativa')->findByCuestionario(null);
       return $this->render(
            "chanppEvImBundle:Cuestionario:alternativa_link.html.twig",
                array('entity'=>$entity, 'preguntas'=>$preguntas,'delete_form'=>$deleteForm->createView()));
    }
    public function alternativa_link_saveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }

        #We get all the PreguntasAlternativas that don't have a Cuestionario set, because these are the ones that can be reapeated
        #Get the original question, create a new one, copy all the values and then link it
        $oldpregunta = $em->getRepository('chanppEvImBundle:PreguntaAlternativa')->find($request->get('old_id'));
        $newpregunta = new PreguntaAlternativa();
        $newpregunta->setEnunciado($oldpregunta->getEnunciado());
        $newpregunta->setTipo($oldpregunta->getTipo());
        $newpregunta->setEje($oldpregunta->getEje());
        $newpregunta->setNumeropregunta(count($entity->getPreguntasdesarrollo()) + count($entity->getPreguntasalternativa()) +1);
        $newpregunta->setAlternativas($oldpregunta->getAlternativas());
        $newpregunta->setCuestionario($entity);
        #Set the parentquestion as the old one
        $newpregunta->setPreguntapadre($oldpregunta);
        $oldpregunta->addPreguntashija($newpregunta);
        $entity->getPreguntasalternativa($newpregunta);
        $em->persist($newpregunta);
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('cuestionario_show', array('id' => $entity->getId())));
    }

    public function desarrollo_linkAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }

        $editForm = $this->createForm(new CuestionarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $preguntas = $em->getRepository('chanppEvImBundle:PreguntaDesarrollo')->findByCuestionario(null);
       return $this->render(
            "chanppEvImBundle:Cuestionario:desarrollo_link.html.twig",
                array('entity'=>$entity, 'preguntas'=>$preguntas,'delete_form'=>$deleteForm->createView()));
    }

    public function desarrollo_link_saveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chanppEvImBundle:Cuestionario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuestionario entity.');
        }

        #We get all the Preguntas that don't have a Cuestionario set, because these are the ones that can be reapeated
        #Get the original question, create a new one, copy all the values and then link it
        $oldpregunta = $em->getRepository('chanppEvImBundle:PreguntaDesarrollo')->find($request->get('old_id'));
        $newpregunta = new PreguntaDesarrollo();
        $newpregunta->setEnunciado($oldpregunta->getEnunciado());
        $newpregunta->setTipo($oldpregunta->getTipo());
        $newpregunta->setEje($oldpregunta->getEje());
        $newpregunta->setNumeropregunta(count($entity->getPreguntasdesarrollo()) + count($entity->getPreguntasalternativa()) +1);
        $newpregunta->setCuestionario($entity);
        #Set the parentquestion as the old one
        $newpregunta->setPreguntapadre($oldpregunta);
        $oldpregunta->addPreguntashija($newpregunta);
        $entity->getPreguntasalternativa($newpregunta);
        $em->persist($newpregunta);
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('cuestionario_show', array('id' => $entity->getId())));
    }
}
