<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CambiosPlanEvaluacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comentario')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\CambiosPlanEvaluacion'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_cambiosplanevaluaciontype';
    }
}
