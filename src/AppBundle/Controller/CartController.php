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
    public function indexAction(){

        return $this->render(":AppBundle/Cart:index.html.twig", []);
    }

    /**
     * @Route("/ajouter/{id}", name="cart_add",
     *     requirements={"id"="\d+"}
     * )
     */
    public function addToCartAction(){
        $serializer = $this->get('jms_serializer');

        $er = $this->getDoctrine()->getRepository('ModelBundle:Book');


        $item = new CartItem();
        $item->setQt(1);
        $item->setBook($er->findAll()[0]);

        $cart = new Cart();
        $cart->setCustomer(null)->addItem($item);

        $serialized = $serializer->serialize($cart, "json");

        $deserialized = $serializer->deserialize(
            $serialized,
            'ModelBundle\Entity\Cart',
            'json'
        );


        return $this->render(":AppBundle/Cart:index.html.twig", [
            'serialized' => $serialized,
            'deserialized' => $deserialized
        ]);
    }

}