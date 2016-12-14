<?php

namespace ModelBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ModelBundle\Entity\Publisher;

class PublisherFixture extends AbstractFixture implements OrderedFixtureInterface
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
        $this->addReference('editeur_1', $publisher);

        $publisher = new Publisher();
        $publisher->setName("Hachette");
        $manager->persist($publisher);
        $this->addReference('editeur_2', $publisher);

        $publisher = new Publisher();
        $publisher->setName("PUF");
        $manager->persist($publisher);
        $this->addReference('editeur_3', $publisher);

        $publisher = new Publisher();
        $publisher->setName("Eyrolles");
        $manager->persist($publisher);
        $this->addReference('editeur_4', $publisher);

        $publisher = new Publisher();
        $publisher->setName("O'Reilly");
        $manager->persist($publisher);
        $this->addReference('editeur_5', $publisher);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}