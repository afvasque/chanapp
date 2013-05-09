<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvaluacionDirectaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resultado')
            ->add('unidad', 'choice', array('choices'   => array('1' => 'Fuel Oil [ton]',
             '2' => 'Diesel [m3]', 
             '3' => 'Gas Licuado (estado líquido) [m3]', 
             '4' => 'Gas Licuado (estado gaseoso) [m3]',
             '5' => 'Gas natural [m3]', 
             '6' => 'Carbón [ton]', 
             '7' => 'Kerosene [m3]',
             '8' => 'Energía Eléctrica Anual [kWh]', 
             '9' => 'Energía Autogenerada [kWh]',  
             '10' => 'Otros [kWh]',),'required'  => true,))
            ->add('descripcion')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\EvaluacionDirecta'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_evaluaciondirectatype';
    }
}
