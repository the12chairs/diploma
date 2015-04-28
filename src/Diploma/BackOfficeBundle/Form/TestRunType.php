<?php

namespace Diploma\BackOfficeBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class TestRunType extends AbstractType
{

    protected $em;

    public function _construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $test = $options['test'];
        $i = 1;
        foreach($test->getQuestions() as $question) {
            $builder->add('question' . $i, 'entity', array(
                'label' => $question->getQuestionText(),
                'class' => 'DiplomaBackOfficeBundle:QuestionVariant',
                'property' => 'variantText',
                'choices' => $question->getVariants(),
                'expanded' => true,
                'multiple' => true,
                'attr' => array(
                    'class' => 'question-title'
                )
            ));
            $i++;
        }

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'test' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'diploma_backofficebundle_test_run';
    }

}
