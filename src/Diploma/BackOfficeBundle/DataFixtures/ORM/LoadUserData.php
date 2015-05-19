<?php
namespace Diploma\BackOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Diploma\BackOfficeBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('test');
        $userAdmin->setEmail('admin@admin.com');
        $userAdmin->AddRole('ROLE_ADMIN');
        $userAdmin->setFirstname('Максим');
        $userAdmin->setLastname('Бондаренко');
        $userAdmin->setEnabled(true);
        $userAdmin->setGrouppa('admin');
        $manager->persist($userAdmin);

        foreach ($this->getData() as $data) {
            $user = new User();

            $user->setUsername($data['username']);
            $user->setPlainPassword($data['password']);
            $user->setEmail($data['email']);
            $user->AddRole('ROLE_USER');
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setEnabled(true);
            $user->setGrouppa('ИТ-41');
            $manager->persist($user);
        }

        $manager->flush();

    }


    private function getData()
    {

        $data = array(
            array(
                'username' => 'user1',
                'password' => 'user1',
                'email'=> 'user1@user1.com',
                'firstname' => 'Test',
                'lastname' => 'User',
            ),
            array(
                'username' => 'user2',
                'password' => 'user2',
                'email'=> 'user2@user2.com',
                'firstname' => 'Test',
                'lastname' => 'User',
            ),
            array(
                'username' => 'user3',
                'password' => 'user3',
                'email'=> 'user3@user3.com',
                'firstname' => 'Test',
                'lastname' => 'User',
            ),
        );

        return $data;
    }
}