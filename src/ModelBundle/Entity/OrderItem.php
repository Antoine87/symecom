<?php

namespace ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItem
 *
 * @ORM\Table(name="order_item")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\OrderItemRepository")
 */
class OrderItem
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
     * @var BookOrder
     * @ORM\ManyToOne(targetEntity="BookOrder", inversedBy="items")
     */
    private $order;

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
     * @return OrderItem
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
     * Set order
     *
     * @param \ModelBundle\Entity\BookOrder $order
     *
     * @return OrderItem
     */
    public function setOrder(\ModelBundle\Entity\BookOrder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \ModelBundle\Entity\BookOrder
     */
    public function getOrder()
    {
        return $this->order;
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
     * @return OrderItem
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
     * @return OrderItem
     */
    public function setBook(\ModelBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }
}
