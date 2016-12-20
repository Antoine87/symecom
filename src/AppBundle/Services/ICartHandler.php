<?php

namespace AppBundle\Services;

use ModelBundle\Entity\Cart;

interface ICartHandler
{
    public function saveCart(Cart $cart);

    public function getCart();
}