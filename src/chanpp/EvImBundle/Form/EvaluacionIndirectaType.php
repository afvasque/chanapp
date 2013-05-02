<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvaluacionIndirectaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ambito')
            ->add('grupoInteres')
            ->add('ejes')
            ->add('responsable')
            ->add('plazo')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\EvaluacionIndirecta'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_evaluacionindirectatype';
    }
}
