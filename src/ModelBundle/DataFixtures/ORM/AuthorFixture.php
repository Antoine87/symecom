<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 14/12/2016
 * Time: 13:14
 */

namespace ModelBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ModelBundle\Entity\Author;

class AuthorFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author->setFirstName("Victor")->setName("Hugo");
        $manager->persist($author);
        $this->addReference('auteur_1', $author);

        $author = new Author();
        $author->setFirstName("Jean")->setName("D'Ormesson");
        $manager->persist($author);
        $this->addReference('auteur_2', $author);

        $author = new Author();
        $author->setFirstName("Joaquim")->setName("Dubellay");
        $manager->persist($author);
        $this->addReference('auteur_3', $author);

        $author = new Author();
        $author->setFirstName("Rémy")->setName("Belleau");
        $manager->persist($author);
        $this->addReference('auteur_4', $author);

        $author = new Author();
        $author->setFirstName("Pierre")->setName("de Ronsard");
        $manager->persist($author);
        $this->addReference('auteur_5', $author);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}