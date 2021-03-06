<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RespuestaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('empresa')
            ->add('mail')
            ->add('telefono')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\Respuesta'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_respuestatype';
    }
}
