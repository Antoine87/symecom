<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class CustomerController
 * @package AppBundle\Controller
 *
 * @Route("/client")
 */
class CustomerController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render(':AppBundle/Customer:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/register")
     */
    public function registerAction()
    {
        return $this->render(':AppBundle/Customer:registration.html.twig', array(
            // ...
        ));
    }

}
