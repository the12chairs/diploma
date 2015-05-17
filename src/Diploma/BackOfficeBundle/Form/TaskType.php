<?php

namespace Diploma\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', 'entity', array(
                'class' => 'DiplomaBackOfficeBundle:User',
                'property' => 'username',
                'label' => 'Назначить'
            ))
            ->add('text', 'textarea', array(
                'attr' => array(
                    'class' => "ckeditor"
                ),
                'label' => 'Текст задания'
            ))
            /*
            ->add('answer', 'ckeditor', array(
                'transformers' => array('html_purifier'),
                'toolbar' => array('document','basicstyles'),
                'toolbar_groups' => array(
                    'document' => array('Source'
                    )),
                'label' => 'Ответ'
            ))
            */
            ->add('rightAnswer', 'textarea', array(
                'attr' => array(
                    'class' => "ckeditor"
                ),
                'label' => 'Верный ответ'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diploma\BackOfficeBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'diploma_backofficebundle_task';
    }
}
