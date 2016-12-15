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
}
