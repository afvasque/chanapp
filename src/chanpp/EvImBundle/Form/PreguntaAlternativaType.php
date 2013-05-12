<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntaAlternativaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
            $builder
            ->add('enunciado')
           ->add('eje', 'choice', array(
        'expanded' => true,
        'choices'  => array(
            '1' => 'Presencia',
            '2'  => 'Valoración',
            '3'   => 'Capacidad Movilizadora',),));
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\PreguntaAlternativa'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_preguntaalternativatype';
    }
}
