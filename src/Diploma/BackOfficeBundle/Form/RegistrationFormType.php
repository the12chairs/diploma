<?php

namespace Diploma\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('username', null, array(
                'label' => 'Имя пользователя',

            ))
            ->add('email','email', array(
                'label' => 'Email',
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array('label' => 'Пароль'),
                'second_options' => array('label' => 'Подтвердите пароль'),
                'invalid_message' => 'Подтверждение не совпадает с паролем!',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diploma\BackOfficeBundle\Entity\User'
        ));
    }


    public function getName()
    {
        return 'diploma_user_registration';
    }
}