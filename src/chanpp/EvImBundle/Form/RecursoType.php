<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion')
            ->add('tipo', 'choice', array('choices'   => array('1' => 'Monetario', '2' => 'Humano', '3' => 'Tiempo', '4' => 'Capacidad', '5' => 'Otro',),'required'  => true,))
            ->add('cantidad')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\Recurso'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_recursotype';
    }
}
