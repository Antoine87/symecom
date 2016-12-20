<?php

namespace AppBundle\Controller;

use ModelBundle\Entity\Customer;
use ModelBundle\Form\CustomerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $catalogRepository = $this->getDoctrine()
            ->getRepository("ModelBundle:Book");
        $tagRepository = $this->getDoctrine()
            ->getRepository('ModelBundle:Tag');

        $authorSummary = $catalogRepository->getAuthorSummary();
        $tagSummary = $tagRepository->getTagSummary();

        return $this->render('default/index.html.twig', [
            'authorSummary' => $authorSummary,
            'tagSummary' => $tagSummary
        ]);
    }

    /**
     * @Route("/login-admin", name="admin_login")
     */
    public function adminLoginAction(){
        $securityUtils = $this->get('security.authentication_utils');

        $error = $securityUtils->getLastAuthenticationError();
        $userName = $securityUtils->getLastUsername();

        return $this->render(':default:admin-login.html.twig', [
            'error' => $error,
            'userName' => $userName
        ]);

    }

    /**
     * @Route("/login-client", name="customer_login")
     */
    public function customerLoginAction(){
        $securityUtils = $this->get('security.authentication_utils');

        $error = $securityUtils->getLastAuthenticationError();
        $userName = $securityUtils->getLastUsername();

        return $this->render(':default:customer-login.html.twig', [
            'error' => $error,
            'userName' => $userName
        ]);

    }

    /**
     * @Route("/inscription-client", name="customer_register")
     */
    public function customerRegisterAction(Request $request){
        $customer = new Customer();

        $form = $this->createForm(
            CustomerType::class
            ,$customer,
            [
                'action' => $this->generateUrl('customer_register')
            ]
            );

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            /**************
             * Auto login
             *************/
            //Génération du token d'authentification
            $token = new UsernamePasswordToken(
                $customer, null,'customer_firewall',$customer->getRoles()
            );
            //Injection du token
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_customer_firewall', serialize($token));

            return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle/Customer/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
