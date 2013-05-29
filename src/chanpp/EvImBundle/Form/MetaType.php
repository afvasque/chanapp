<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('plazo', null, array(
                'label' => 'Indicar a continuación el plazo en el cual se debe cumplir la meta.
Primero introduzca el mes en el que se cumplirá (mm) y luego el año (aaaa)'))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\Meta'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_metatype';
    }
}
