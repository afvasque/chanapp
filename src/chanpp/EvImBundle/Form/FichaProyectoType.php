<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use chanpp\EvImBundle\Entity\FichaProyecto;

class FichaProyectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area_accion','choice', array(
                'empty_value' => 'Elegir un área de acción',
                'label' => 'Área de acción',
                'choices' => FichaProyecto::getAreasAccion(),
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('linea_accion','choice', array(
                'label' => 'Línea de acción',
                'choices' => FichaProyecto::getLineasAccion(),
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('nombre','text', array(
                'label' => 'Nombre del Programa',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('jefe','text', array(
                'label' => 'Jefe de Proyecto',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('duracion','text', array(
                'label' => 'Duración del Proyecto',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('diagnostico_previo','text', array(
                'label' => 'Diagnóstico previo a aplicación del proyecto',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('obj_general','text', array(
                'label' => 'Objetivo General',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('objs_especificos','text', array(
                'label' => 'Objetivos Específicos',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('descripcion','textarea', array(
                'label' => 'Descripción del Proyecto',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('desc_causales','text', array(
                'label' => 'Justificación del Proyecto',
                'label_attr' => array(
                        'class'=>'control-label')))
            ->add('variables_causales','text', array(
                'label' => 'Variables Relevantes',
                'label_attr' => array(
                        'class'=>'control-label')))
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
