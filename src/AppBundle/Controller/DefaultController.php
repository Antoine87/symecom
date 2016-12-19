<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
}
