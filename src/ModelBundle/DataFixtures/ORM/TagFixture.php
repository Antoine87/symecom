<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 14/12/2016
 * Time: 13:24
 */

namespace ModelBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use ModelBundle\Entity\Tag;

class TagFixture extends AbstractFixture
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

        $tag = new Tag();
        $tag->setTagName("Roman");
        $manager->persist($tag);

        $tag = new Tag();
        $tag->setTagName("Poésie");
        $manager->persist($tag);

        $tag = new Tag();
        $tag->setTagName("Humour");
        $manager->persist($tag);

        $tag = new Tag();
        $tag->setTagName("SQL");
        $manager->persist($tag);

        $tag = new Tag();
        $tag->setTagName("Web");
        $manager->persist($tag);

        $tag = new Tag();
        $tag->setTagName("Philosophie");
        $manager->persist($tag);

        $manager->flush();
    }
}