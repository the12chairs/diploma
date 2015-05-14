<?php

namespace Diploma\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'Заголовок'
            ))
            ->add('postText', 'textarea', array(
                'attr' => array(
                    'class' => "ckeditor"
                )
            ))
            /*
            ->add('postText', 'ckeditor', array(
                'transformers' => array('html_purifier'),
                'toolbar' => array('document','basicstyles'),
                'toolbar_groups' => array(
                    'document' => array('Source'
                )),
                'label' => ' '
            ))
            */
            ->add('tags', 'entity', array(
                'label' => 'Добавить тэги',
                'class' => 'DiplomaBackOfficeBundle:Tag',
                'property' => 'title',
                'multiple' => true
            ))
            ->add('submit','submit', array(
                'label' => 'Сохранить',
                'attr' => array(
                    'class' => 'btn btn-success'
                )
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diploma\BackOfficeBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'diploma_backofficebundle_post';
    }
}
