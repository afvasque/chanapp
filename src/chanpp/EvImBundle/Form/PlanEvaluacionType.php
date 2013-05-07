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
            ->add('destinatarios','text',array('label'  => 'Destinatarios de la información',))
            ->add('instanciasNumeroEvaluaciones','integer',array('label'  => 'Número de evaluaciones','data' => '0'))
            ->add('instanciasPlazo','text',array('label'  => 'Plazo para las evaluaciones (Ejemplo "12 Meses")',))
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
