<?php

namespace chanpp\EvImBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvaluacionIndirectaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ambito', 'choice', array('choices'   => array('1' => 'Capacitación/Educación', '2' => 'Información/Difusión', '3' => 'Otras Transformaciones de Mercado',),'required'  => true, 'label' => 'Ámbito del objetivo del programa',))
            ->add('grupoInteres','textarea',array('label'  => 'Grupo de interés de la sub-evaluación',))
            ->add('ejes', 'choice', array(
        'expanded' => true,
        'multiple' => true,
        'choices'  => array(
            '1' => 'Presencia',
            '2'  => 'Valoración',
            '3'   => 'Capacidad Movilizadora',),))
            ->add('responsable','text',array('label'  => 'Responsable de la ejecución',))
            ->add('plazo','text',array('label'  => 'Plazo de la ejecución (meses)',))
            ->add('metodosrecoleccion', 'entity', array(
'multiple' => true,
'expanded' => true,
'class'    => 'chanppEvImBundle:MetodoRecoleccion',
'property' => 'nombre',
'label'  => 'Método de recolección de datos'
));
  }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chanpp\EvImBundle\Entity\EvaluacionIndirecta'
        ));
    }

    public function getName()
    {
        return 'chanpp_evimbundle_evaluacionindirectatype';
    }
}
