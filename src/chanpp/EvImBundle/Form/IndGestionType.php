<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IndGestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array(
                'label' => "Nombre del Indicador de Gestión"))
            ->add('anoDeadline')
            ->add('mesDeadline')
            ->add('variables_obstaculo', null, array(
                'label' => "Variables obstaculo"))
            ->add('ficha_proyecto', null, array('label'=>'Ficha de Proyecto'))
        ;
        $builder
            ->add('metas','collection',array(
                'type' => new MetaType(),
                'allow_add'=> true,
                'allow_delete'=> true,
                'by_reference' => false,
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\IndGestion'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_indgestiontype';
    }
}
