<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvaluacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('alcance')
            ->add('duracion','text',array('label'  => 'Duración de la evaluación (meses)',))
            ->add('actividades', 'entity', array(
'multiple' => true,
'expanded' => true,
'class'    => 'chanppEvImBundle:Activity',
'property' => 'nombre',  
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
}
