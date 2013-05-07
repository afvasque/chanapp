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
            ->add('duracion','text',array('label'  => 'Meses de evaluación',))
            ->add('confiabilidad','textarea',array('label'  => 'Nivel de confiabilidad de los resultados que se requiere',))
        ;
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
