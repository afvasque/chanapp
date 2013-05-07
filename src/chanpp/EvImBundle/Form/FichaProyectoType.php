<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FichaProyectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area_accion')
            ->add('linea_accion')
            ->add('nombre')
            ->add('jefe')
            ->add('duracion')
            ->add('diagnostico_previo')
            ->add('obj_general')
            ->add('objs_especificos')
            ->add('descripcion')
            ->add('desc_causales')
            ->add('variables_causales')
        ;

        $builder->add('activities', 'collection', array(
            'type' => new ActivityType(),
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\FichaProyecto'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_fichaproyectotype';
    }
}
