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
        $userAdmin->setEnabled(true);
        $manager->persist($userAdmin);
        $manager->flush();
    }
}