<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 14/12/2016
 * Time: 13:28
 */

namespace ModelBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use ModelBundle\Entity\Address;
use ModelBundle\Entity\Customer;

class CustomerFixture extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setName("Obama")
            ->setFirstName("Barack")
            ->setBirthDate(new \DateTime("today -48 year"))
            ->setEmail("obama@mail.com");

        $address = new Address();
        $address->setAddress("5 rue Orfila")
            ->setPostalCode("75020")
            ->setTown("Paris")
            ->setCountry("France")
            ->setCustomer($customer);

        $customer->addAdress($address);
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName("Chirac")
            ->setFirstName("Jacques")
            ->setBirthDate(new \DateTime("today -75 year"))
            ->setEmail("chirac@mail.com");

        $address = new Address();
        $address->setAddress("5 rue de la grande truanderie")
            ->setPostalCode("75001")
            ->setTown("Paris")
            ->setCountry("France")
            ->setCustomer($customer);

        $customer->addAdress($address);
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName("Trump")
            ->setFirstName("Donald")
            ->setBirthDate(new \DateTime("today -70 year -15 day"))
            ->setEmail("trump@mail.com");

        $address = new Address();
        $address->setAddress("3 rue des boulets")
            ->setPostalCode("75005")
            ->setTown("Paris")
            ->setCountry("France")
            ->setCustomer($customer);

        $customer->addAdress($address);
        $manager->persist($customer);

        $manager->flush();
    }
}