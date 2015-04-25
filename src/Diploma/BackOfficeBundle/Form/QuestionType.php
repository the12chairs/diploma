<?php

namespace Diploma\BackOfficeBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class QuestionType extends AbstractType
{
    private $em;

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine.orm.entity_manager');
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->em;

        $testId = $options['testId'];

        if($testId) {
            $test = $em->getRepository('DiplomaBackOfficeBundle:Test')->find($testId);
        } else {
            $test = null;
        }


        $builder
            ->add('questionText', 'text')
            ->add('test', 'entity', array(
                'label' => 'Прикрепить к тесту',
                'class' => 'DiplomaBackOfficeBundle:Test',
                'property' => 'title',
                'data' => $test
            )) ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diploma\BackOfficeBundle\Entity\Question',
            'testId' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'diploma_backofficebundle_question';
    }
}
