<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

        $basePath = $this->generateUrl("catalog_home");

        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            "catalog" => $catalog,
            "numberOfBooks" => $numberOfBooks,
            'nbOfPages' => $nbOfPages,
            'currentPage' => $page,
            'basePath' => $basePath
        ));
    }

    /**
     * @Route("/details/{id}", name="catalog_details")
     */
    public function detailsAction($id, Request $request)
    {
        $bookRepository = $this->getDoctrine()
            ->getRepository('ModelBundle:Book');
        $book = $bookRepository->find($id);

        $origin = str_replace(
            "http://".$request->headers->get("host"),
            "",
            $request->headers->get('referer')
        );

        $origin = $request->headers->get('referer');

        return $this->render(':AppBundle/Catalog:details.html.twig', array(
            'book' => $book,
            'origin' => $origin
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
     * @Route("/par-auteur/{authorName}/page/{page}", name="catalog_by_author"
     * , requirements={"page"="\d+"}, defaults={"page"=1}
     * )
     */
    public function byAuthorAction($authorName,$page)
    {
        $bookRepositository = $this->getDoctrine()
            ->getRepository('ModelBundle:Book');
        $catalog = $bookRepositository->findByAuthorPaginated(
            $authorName, $this->maxPerPage,$page
        );

        $numberOfBooks = $bookRepositository->getTotalNumberOfBooksByAuthor($authorName);
        $nbOfPages = ceil($numberOfBooks / $this->maxPerPage);

        $queryTitle = "par auteur : $authorName";

        $basePath = $this->generateUrl("catalog_by_author", ["authorName" => $authorName]);

        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            "catalog" => $catalog,
            "numberOfBooks" => $numberOfBooks,
            'nbOfPages' => $nbOfPages,
            'currentPage' => $page,
            'queryTitle' => $queryTitle,
            'basePath' => $basePath
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
