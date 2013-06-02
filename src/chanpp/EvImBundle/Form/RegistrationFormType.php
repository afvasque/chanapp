<?php

namespace chanpp\EvImBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre');
        parent::buildForm($builder, $options);
        $builder
            ->add('roles', 'choice', array(
                'expanded'   => true,
                'multiple' => true,
                'choices'  => array(
                    'ROLE_PLANIFICADOR' => 'Planificador',
                    'ROLE_EVALUADOR'     => 'Evaluador',
                    'ROLE_VISITA'    => 'Visita',
                ),

            )
        );

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'acme_user_registration';
    }
}