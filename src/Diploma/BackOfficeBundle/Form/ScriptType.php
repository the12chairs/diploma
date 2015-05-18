<?php

namespace Diploma\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScriptType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'название'
            ))
            ->add('code', 'textarea', array(
                'label' => 'Код'
            ))
            ->add('difficult', 'text', array(
                'label' => 'Сложность алгоритма'
            ))
            ->add('post', 'entity', array(
                'class' => 'DiplomaBackOfficeBundle:Post',
                'property' => 'title',
                'label' => 'Прикрепить к статье'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diploma\BackOfficeBundle\Entity\Script'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'diploma_backofficebundle_script';
    }
}
