<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlanEvaluacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objetivos')
            ->add('destinatarios')
            ->add('instanciasNumeroEvaluaciones')
            ->add('instanciasPlazo')
            ->add('idFichaProyecto')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\PlanEvaluacion'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_planevaluaciontype';
    }
}
