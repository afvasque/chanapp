<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array(
                'label' => "Nombre"))
            ->add('descripcion', null, array(
                'label' => "Descripción de la meta"))
            ->add('resultadosEsperados', null, array(
                'label' => "Resultados Esperados"))
            ->add('duracion', null, array(
                'label' => "Duración"))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\Activity'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_activitytype';
    }
}
