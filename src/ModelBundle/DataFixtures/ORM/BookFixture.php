<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 14/12/2016
 * Time: 14:18
 */

namespace ModelBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ModelBundle\Entity\Book;

class BookFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $book = new Book();
        $book->setAuthor($this->getReference('auteur_1'))
            ->setPublisher($this->getReference('editeur_1'))
            ->setTitle("Les fleurs du mal")
            ->setAbstract("Le résumé du bouquin")
            ->setPrice(15.8)
            ->setDatePublished(new \DateTime("today -5 year"))
            ->addTag($this->getReference("tag_1"))
            ->addTag($this->getReference("tag_2"))
            ->addTag($this->getReference("tag_3"));
        $manager->persist($book);
        $this->addReference('livre_1', $book);

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }
}