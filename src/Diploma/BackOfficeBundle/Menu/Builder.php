<?php

namespace Diploma\BackOfficeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function topMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        $menu->addChild('Post', array(
            'label' => 'Статьи',
        ))
            ->setAttribute('icon', 'icon-file')
            ->setAttribute('dropdown', true)
        ;

        $menu['Post']->addChild('Index', array(
            'route' => 'post',
            'label' => 'Список статей'
        ))
            ->setAttribute('icon', 'icon-list');

        $menu['Post']->addChild('Search', array(
            'route' => 'post_search',
            'label' => 'Поиск статей'
        ))
            ->setAttribute('icon', 'icon-search')
        ;

        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $menu['Post']->addChild('Create', array(
                'route' => 'post_new',
                'label' => 'Добавить статью'
            ))
                ->setAttribute('icon', 'icon-pencil')
            ;
        }

        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Script', array(
                'label' => 'Код',
                'route' => 'script'
            ))
                ->setAttribute('icon', 'icon-file')
                ->setAttribute('divider_prepend', true);
        }

        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Tag', array(
                'label' => 'Тэги',
                'route' => 'tag'
            ))
                ->setAttribute('icon', 'icon-tags')
                ->setAttribute('divider_prepend', true);
        }


        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Test', array(
                'label' => 'Тесты',
            ))
                ->setAttribute('icon', 'icon-edit')
                ->setAttribute('divider_prepend', true)
                ->setAttribute('dropdown', true)
            ;

            $menu['Test']->addChild('Index', array(
                'route' => 'test',
                'label' => 'Список тестов'
            ))
                ->setAttribute('icon', 'icon-list')
            ;

            $menu['Test']->addChild('Create', array(
                'route' => 'test_new',
                'label' => 'Составить тест'
            ))
                ->setAttribute('icon', 'icon-pencil')
            ;
        }


        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Task', array(
                'label' => 'Задания',
            ))
                ->setAttribute('icon', 'icon-columns')
                ->setAttribute('divider_prepend', true)
                ->setAttribute('dropdown', true)
            ;

            $menu['Task']->addChild('Index', array(
                'route' => 'task',
                'label' => 'Список заданий'
            ))
                ->setAttribute('icon', 'icon-list')
            ;

            $menu['Task']->addChild('Create', array(
                'route' => 'task_new',
                'label' => 'Создать индивидуальное задание'
            ))
                ->setAttribute('icon', 'icon-pencil')
            ;
        }



        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');


        $username = null;
        if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {
            $username = $this->container->get('security.context')->getToken()->getUser()->getUsername();
        }

        $menu->addChild('User', array('label' => $username? : 'Анонимус'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'icon-user');

        if($username) {
            $menu['User']->addChild('Profile Edit', array(
                'route' => 'user_edit',
                'label' => 'Редактировать профиль'
            ))
                ->setAttribute('icon', 'icon-edit')
                ->setAttribute('divider_append', true)
            ;

            $menu['User']->addChild('Messages', array(
                'route' => 'user_messages',
                'label' => 'Сообщения'
            ))
                ->setAttribute('icon', 'icon-envelope')
            ;

            $menu['User']->addChild('Logout', array(
                'route' => 'fos_user_security_logout',
                'label' => 'Выход'
            ))
                ->setAttribute('icon', 'icon-signout');
        } else {
            $menu['User']->addChild('Login', array(
                'route' => 'fos_user_security_login',
                'label' => 'Войти'
            ))
                ->setAttribute('icon', 'icon-signin');
            $menu['User']->addChild('Register', array(
                'route' => 'fos_user_registration_register',
                'label' => 'Зарегистрироваться'
            ))
                ->setAttribute('icon', 'icon-signin');
        }
        return $menu;
    }

}
