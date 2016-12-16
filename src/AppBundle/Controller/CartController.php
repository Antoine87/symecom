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

        $cart = $this->getCartFromSession($request);
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
        $cart = $this->getCartFromSession($request);

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

        $this->saveCartToSession($request, $cart);

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
        $cart = $this->getCartFromSession($request);
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

        $this->saveCartToSession($request, $cart);

        return $this->redirectToRoute('cart_home');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/vider", name="cart_clear")
     */
    public function clearAction(Request $request){
        $cart = $this->getCartFromSession($request);

        $cart->deleteAllItems();

        $this->saveCartToSession($request, $cart);

        return $this->redirectToRoute('catalog_home');
    }

    /**
     * Récupération d'un panier à partir des données de la session
     * @param Request $request
     * @return array|\JMS\Serializer\scalar|mixed|Cart|object
     */
    private function getCartFromSession(Request $request){
        $serializedCart = $request->getSession()->get("cart",null);
        $serializer = $this->get('jms_serializer');

        if(empty($serializedCart)){
            $cart = new Cart();
        } else {
            $cart = $serializer->deserialize(
                $serializedCart,
                'ModelBundle\Entity\Cart',
                'json'
            );
        }

        return $cart;
    }

    private function saveCartToSession(Request $request, Cart $cart){
        $serializer = $this->get('jms_serializer');
        $serializedCart = $serializer->serialize($cart, 'json');
        $request->getSession()->set('cart', $serializedCart);
    }
}