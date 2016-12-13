<?php

namespace AppBundle\Controller;

use ModelBundle\Entity\Address;
use ModelBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PlayGroundController
 * @package AppBundle\Controller
 *
 * @Route("playground")
 */
class PlayGroundController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        //Récupération du dépôt de requête
        $er = $this->getDoctrine()->getRepository('ModelBundle:Customer');
        $client = $er->findOneByEmail('dujardin@mail.com');

        if($client == null){
            $this->persistCustomer();
        }

        $clients = $er->findAll();

        return $this->render('AppBundle:PlayGround:index.html.twig',
            array(
                'client' => $client,
                'clientList' => $clients
            )
        );
    }

    private function persistCustomer(){
        //Instanciation du client
        $client = new Customer();
        $client->setName('Dujardin')->setFirstName('Alain')
            ->setBirthDate(new \DateTime("today -40 year"))
            ->setEmail('dujardin@mail.com');

        //Instanciation de l'adresse
        $adresse = new Address();
        $adresse->setAddress("5 rue Orfila")->setPostalCode("75020")
            ->setTown("Paris")->setCountry("France")
            ->setCustomer($client);
        //Liaison entre l'adresse et le client
        $client->addAdress($adresse);

        //Persistance de l'objet en base de données

        //Récupération du gestionnaire d'entité de Doctrine
        $em = $this->getDoctrine()->getManager();

        //Persistance de l'entité client
        $em->persist($client);

        //Commit de la transaction
        $em->flush();
    }

}
