<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 14/12/2016
 * Time: 13:24
 */

namespace ModelBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ModelBundle\Entity\Tag;

class TagFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tag = new Tag();
        $tag->setTagName("Informatique");
        $manager->persist($tag);
        $this->addReference('tag_1', $tag);

        $tag = new Tag();
        $tag->setTagName("Roman");
        $manager->persist($tag);
        $this->addReference('tag_2', $tag);

        $tag = new Tag();
        $tag->setTagName("Poésie");
        $manager->persist($tag);
        $this->addReference('tag_3', $tag);

        $tag = new Tag();
        $tag->setTagName("Humour");
        $manager->persist($tag);
        $this->addReference('tag_4', $tag);

        $tag = new Tag();
        $tag->setTagName("SQL");
        $manager->persist($tag);
        $this->addReference('tag_5', $tag);

        $tag = new Tag();
        $tag->setTagName("Web");
        $manager->persist($tag);
        $this->addReference('tag_6', $tag);

        $tag = new Tag();
        $tag->setTagName("Philosophie");
        $manager->persist($tag);
        $this->addReference('tag_7', $tag);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}