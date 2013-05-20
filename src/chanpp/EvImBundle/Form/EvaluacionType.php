<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvaluacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = $this->options;
        $builder
            ->add('nombre')
            ->add('alcance')
            ->add('duracion','text',array('label'  => 'Duración de la evaluación (meses)',))
            //->add('duracion','text',array('label'  => $options['planevaluacionid'] ,))
            ->add('actividades', 'entity', array(
'multiple' => true,
'expanded' => true,
'class'    => 'chanppEvImBundle:Activity',
'property' => 'nombre',  
//'query_builder' => function(EntityRepository $er)  {
  //                      return $er->createQueryBuilder('u')               
    //                      ->where('u.ficha_proyecto_id = '. $options['fichaid'] );
      //                }     
'query_builder' => function($repository) { $options = $this->options;
        return $repository->createQueryBuilder('u')
        ->where('u.ficha_proyecto = '. $options['fichaid'] );
    },
));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\Evaluacion'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_evaluaciontype';
    }

    public function __construct($options) {
    $this->options = $options;
}
}
