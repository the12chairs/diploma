<?php

namespace Diploma\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class QuestionVariantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('variantText', 'text', array(
                'label' => 'Вопрос'
            ))
            ->add('question', 'entity', array(
                'class' => 'DiplomaBackOfficeBundle:Question',
                'property' => 'questionText',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('q');
                },
            ))
            ->add('isRight', 'checkbox', array(
                'label' => 'Верный ответ?',
                'required' => 'false'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diploma\BackOfficeBundle\Entity\QuestionVariant'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'diploma_backofficebundle_questionvariant';
    }
}
