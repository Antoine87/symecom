<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 20/12/2016
 * Time: 14:54
 */

namespace AppBundle\Services;


use JMS\Serializer\Serializer;
use ModelBundle\Entity\Cart;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCartHandler implements ICartHandler
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Request
     */
    private $request;

    /**
     * SessionCartHandler constructor.
     * @param RequestStack $requestStack
     * @param Serializer $serializer
     */
    public function __construct(RequestStack $requestStack, Serializer $serializer)
    {
        $this->requestStack = $requestStack;
        $this->serializer = $serializer;

        $this->request= $this->requestStack->getCurrentRequest();
    }

    public function saveCart(Cart $cart){
        $serializedCart = $this->serializer->serialize($cart, 'json');
        $this->request->getSession()->set('cart', $serializedCart);
    }

    public function getCart(){
        $serializedCart = $this->request->getSession()->get("cart",null);

        if(empty($serializedCart)){
            $cart = new Cart();
        } else {
            $cart = $this->serializer->deserialize(
                $serializedCart,
                'ModelBundle\Entity\Cart',
                'json'
            );
        }

        return $cart;
    }


}