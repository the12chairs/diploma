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
            ->add('user')
            ->add('text', 'ckeditor', array(
                'transformers' => array('html_purifier'),
                'toolbar' => array('document','basicstyles'),
                'toolbar_groups' => array(
                    'document' => array('Source'
                    )),
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
            ->add('rightAnswer', 'ckeditor', array(
                'transformers' => array('html_purifier'),
                'toolbar' => array('document','basicstyles'),
                'toolbar_groups' => array(
                    'document' => array('Source'
                    )),
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
