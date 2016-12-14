<?php

namespace ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Cart;

/**
 * CartItem
 *
 * @ORM\Table(name="cart_item")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\CartItemRepository")
 */
class CartItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="qt", type="integer")
     */
    private $qt;

    /**
     * @var Cart
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="items")
     */
    private $cart;

    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book")
     */
    private $book;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set qt
     *
     * @param integer $qt
     *
     * @return CartItem
     */
    public function setQt($qt)
    {
        $this->qt = $qt;

        return $this;
    }

    /**
     * Get qt
     *
     * @return int
     */
    public function getQt()
    {
        return $this->qt;
    }

    /**
     * Set cart
     *
     * @param \ModelBundle\Entity\Cart $cart
     *
     * @return CartItem
     */
    public function setCart(\ModelBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \ModelBundle\Entity\Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->book = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add book
     *
     * @param \ModelBundle\Entity\Book $book
     *
     * @return CartItem
     */
    public function addBook(\ModelBundle\Entity\Book $book)
    {
        $this->book[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \ModelBundle\Entity\Book $book
     */
    public function removeBook(\ModelBundle\Entity\Book $book)
    {
        $this->book->removeElement($book);
    }

    /**
     * Get book
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set book
     *
     * @param \ModelBundle\Entity\Book $book
     *
     * @return CartItem
     */
    public function setBook(\ModelBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }
}
