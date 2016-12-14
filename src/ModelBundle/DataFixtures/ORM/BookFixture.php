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
use Faker\Factory;
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
        $nbBooks = 100;

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

        $faker = Factory::create("us_US");

        for($i=2; $i<=$nbBooks; $i++){

            $book = new Book();

            $author_ref = "auteur_". rand(1,5);
            $publisher_ref = "editeur_". rand(1,5);

            $book->setAuthor($this->getReference($author_ref))
                ->setPublisher($this->getReference($publisher_ref))
                ->setTitle($faker->bs)
                ->setAbstract($faker->paragraphs(rand(1,8), true))
                ->setPrice($faker->randomFloat(2,1,80))
                ->setDatePublished($faker->dateTimeThisCentury);

                        $nbTags = rand(0,5);
                        $allowedTags = range(1,7);
                        shuffle($allowedTags);

                        for($k=1; $k<= $nbTags; $k++){
                            $tagNumber = array_pop($allowedTags);
                            $book->addTag($this->getReference("tag_$tagNumber"));
                        }

            $manager->persist($book);
            $this->addReference('livre_'.$i, $book);
        }

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