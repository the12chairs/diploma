<?php
namespace Diploma\BackOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Diploma\BackOfficeBundle\Entity\Tag;

class LoadTagData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        foreach ($this->getData() as $data) {
            $tag = new Tag();

            $tag->setTitle($data['title']);

            $manager->persist($tag);
        }

        $manager->flush();
    }


    private function getData()
    {

        $data = array(
            array(
                'title' => 'Вычмат',
            ),
            array(
                'title' => 'Матрицы',
            ),
            array(
                'title' => 'СЛАУ',
            ),
            array(
                'title' => 'Диффуры',
            ),
        );

        return $data;
    }
}