<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 20/12/2016
 * Time: 15:11
 */

namespace AppBundle\Services;


use Doctrine\ORM\EntityManager;
use ModelBundle\Entity\Cart;
use ModelBundle\Repository\CartRepository;
use Symfony\Bundle\SecurityBundle\Security\FirewallContext;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\User\UserInterface;

class DataBaseCartHandler implements ICartHandler
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var CartRepository
     */
    private $repository;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var TokenStorage
     */
    private $token;

    /**
     * DataBaseCartHandler constructor.
     * @param EntityManager $entityManager
     * @param CartRepository $Repository
     * @param UserInterface $user
     */
    public function __construct(EntityManager $entityManager, CartRepository $Repository, TokenStorage $token)
    {
        $this->entityManager = $entityManager;
        $this->repository = $Repository;
        $this->user = $token->getToken()->getUser();
    }


    public function saveCart(Cart $cart)
    {
        $cart->setCustomer($this->user);

        $this->entityManager->persist($cart);
        $this->entityManager->flush();
    }

    public function getCart()
    {
        return $this->repository->findOneByUser($this->user);
    }
}