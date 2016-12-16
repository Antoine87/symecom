<?php

namespace AppBundle\Controller;

use ModelBundle\Entity\Comment;
use ModelBundle\Form\CommentType;
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
    private $maxPerPage = 5;


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

        //Création du formulaire
        $comment = new Comment();
        $comment->setBook($book)->setCreatedAt(new \DateTime());
        $form = $this->createForm(
            CommentType::class,
            $comment,
            [
                'action' => $this->generateUrl('catalog_details', ['id' => $id]),
                'attr' => ['novalidate'=>'novalidate']
            ]
        );

        //Traitement du formulaire
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('catalog_details', ['id'=>$id]);
        }

        $commentRepository = $this->getDoctrine()
            ->getRepository('ModelBundle:Comment');
        $comments = $commentRepository->findByBook($book);

        $origin = str_replace(
            "http://".$request->headers->get("host"),
            "",
            $request->headers->get('referer')
        );

        $origin = $request->headers->get('referer');

        return $this->render(':AppBundle/Catalog:details.html.twig', array(
            'book' => $book,
            'origin' => $origin,
            'commentForm' => $form->createView(),
            'comments' => $comments
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
     * @Route("/par-categorie/{tag}/page/{page}", name="catalog_by_tag",
     *     requirements={"page"="\d+"}, defaults={"page"=1})
     */
    public function byTagAction($tag, $page)
    {
        $bookRepositository = $this->getDoctrine()
            ->getRepository('ModelBundle:Book');
        $catalog = $bookRepositository->findByTagPaginated(
            $tag, $this->maxPerPage,$page
        );

        $numberOfBooks = $bookRepositository->getTotalNumberOfBooksByTag($tag);
        $nbOfPages = ceil($numberOfBooks / $this->maxPerPage);

        $queryTitle = "par tag : $tag";

        $basePath = $this->generateUrl("catalog_by_tag", ["tag" => $tag]);

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
     * @Route("/recherche", name="catalog_search")
     */
    public function searchAction()
    {
        return $this->render(':AppBundle/Catalog:index.html.twig', array(
            // ...
        ));
    }

}
