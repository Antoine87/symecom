<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class CatalogController
 * @package AppBundle\Controller
 *
 * @Route("/catalogue")
 */
class CatalogController extends Controller
{
    private $maxPerPage = 10;

    /**
     * @Route("/page/{page}", name="catalog_home",
     *     requirements={"page"="\d+"},
     *     defaults={"page"=1}
     *
     *)
     */
    public function indexAction($page)
    {
        $bookRepositository = $this->getDoctrine()
            ->getRepository('ModelBundle:Book');
        $catalog = $bookRepositository->findAllPaginated(
            $this->maxPerPage,$page
        );

        $numberOfBooks = $bookRepositository->getTotalNumberOfBooks();
        $nbOfPages = ceil($numberOfBooks / $this->maxPerPage);

        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            "catalog" => $catalog,
            "numberOfBooks" => $numberOfBooks,
            'nbOfPages' => $nbOfPages,
            'currentPage' => $page
        ));
    }

    /**
     * @Route("/details/{id}", name="catalog_details")
     */
    public function detailsAction($id)
    {
        return $this->render(':AppBundle/Catalog:details.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/details/{id}/ajouter-commentaire", name="catalog_add_comment")
     */
    public function addCommentAction($id)
    {
        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/par-auteur/{auteur}", name="catalog_by_author")
     */
    public function byAuthorAction()
    {
        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/par-categorie/{tag}", name="catalog_by_tag")
     */
    public function byTagAction()
    {
        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/recherche", name="catalog_search")
     */
    public function searchAction()
    {
        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            // ...
        ));
    }

}
