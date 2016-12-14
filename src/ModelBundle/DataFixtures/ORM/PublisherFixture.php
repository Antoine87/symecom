<?php

namespace ModelBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use ModelBundle\Entity\Publisher;

class PublisherFixture extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $publisher = new Publisher();
        $publisher->setName("Grasset");
        $manager->persist($publisher);

        $publisher = new Publisher();
        $publisher->setName("Hachette");
        $manager->persist($publisher);

        $publisher = new Publisher();
        $publisher->setName("PUF");
        $manager->persist($publisher);

        $publisher = new Publisher();
        $publisher->setName("Eyrolles");
        $manager->persist($publisher);

        $publisher = new Publisher();
        $publisher->setName("O'Reilly");
        $manager->persist($publisher);


        $manager->flush();
    }
}