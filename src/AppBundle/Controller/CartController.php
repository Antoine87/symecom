<?php


namespace AppBundle\Controller;


use ModelBundle\Entity\Author;
use ModelBundle\Entity\Cart;
use ModelBundle\Entity\CartItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CartController
 * @package AppBundle\Controller
 * @Route("/panier")
 */
class CartController extends Controller
{

    /**
     * @Route("/", name="cart_home")
     */
    public function indexAction(Request $request){

        $cart = $this->getCartHandler()->getCart();
        $referer = $request->getSession()->get('cartReferer',
            $this->generateUrl('catalog_home')
        );

        return $this->render(":AppBundle/Cart:index.html.twig", [
            'cart' => $cart,
            'referer' => $referer
        ]);
    }

    /**
     * @Route("/ajouter/{id}", name="cart_add",
     *     requirements={"id"="\d+"}
     * )
     */
    public function addToCartAction(Request $request, $id){
        $cart = $this->getCartHandler()->getCart();

        $er = $this->getDoctrine()->getRepository('ModelBundle:Book');
        $book = $er->find($id);

        if($book != null){

            //Recherche d'un livre dans le panier
            $bookId = $book->getId();
            $items = $cart->getItems()->toArray();
            $index = -1;

            for($i=0; $i < count($items) && $index <0; $i++){
                $itemBook = $items[$i]->getBook();
                if($itemBook->getId() == $bookId){
                    $index = $i;
                }
            }

            //Affectation d'un livre au panier
            // ou modification de la quantité pour un livre existant
            if($index <0){
                $cartItem = new CartItem();
                $cartItem->setBook($book)->setQt(1);
                $cart->addItem($cartItem);
            } else {
                $cart->getItems()[$index]->addQuantity(1);
            }
        }

        $this->getCartHandler()->saveCart($cart);

        $this->addFlash("cartInfo", "Votre produit a été ajouté au panier");
        $request->getSession()->set("cartReferer", $request->headers->get("referer"));


        return $this->redirectToRoute('cart_home');
    }

    /**
     * @param Request $request
     * @Route("/recalculer", name="cart_update")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request){
        $newQt = $request->request->get("qt");
        $cart = $this->getCartHandler()->getCart();
        $toBeDeleted = [];

        for($i=0; $i< count($newQt); $i++){
            $qt = $newQt[$i];
            $cart->getItems()[$i]->setQt($qt);
            if($qt == 0){
                $toBeDeleted[] = $i;
            }
        }

        foreach ($toBeDeleted as $deleteIndex){
            $cart->getItems()->remove($deleteIndex);
        }

        $this->getCartHandler()->saveCart($cart);

        return $this->redirectToRoute('cart_home');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/vider", name="cart_clear")
     */
    public function clearAction(Request $request){
        $cart = $this->getCartHandler()->getCart();

        $cart->deleteAllItems();

        $this->getCartHandler()->saveCart($cart);

        return $this->redirectToRoute('catalog_home');
    }

    /**
     * @return \AppBundle\Services\SessionCartHandler
     */
    private function getCartHandler(){
        if( in_array('ROLE_USER', $this->getUser()->getRoles())){
            return $this->get("database.cart.handler");
        } else {
            return $this->get("session.cart.handler");
        }

    }
}