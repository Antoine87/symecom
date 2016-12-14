<?php

namespace ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ModelBundle\Entity\Customer;
use ModelBundle\Entity\OrderItem;

/**
 * BookOrder
 *
 * @ORM\Table(name="book_order")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\BookOrderRepository")
 */
class BookOrder
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateOrdered", type="date")
     */
    private $dateOrdered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateShipped", type="date")
     */
    private $dateShipped;

    /**
     * @var Customer
     * @ORM\OneToOne(targetEntity="Customer")
     */
    private $customer;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order")
     */
    private $items;

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
     * Set dateOrdered
     *
     * @param \DateTime $dateOrdered
     *
     * @return BookOrder
     */
    public function setDateOrdered($dateOrdered)
    {
        $this->dateOrdered = $dateOrdered;

        return $this;
    }

    /**
     * Get dateOrdered
     *
     * @return \DateTime
     */
    public function getDateOrdered()
    {
        return $this->dateOrdered;
    }

    /**
     * Set dateShipped
     *
     * @param \DateTime $dateShipped
     *
     * @return BookOrder
     */
    public function setDateShipped($dateShipped)
    {
        $this->dateShipped = $dateShipped;

        return $this;
    }

    /**
     * Get dateShipped
     *
     * @return \DateTime
     */
    public function getDateShipped()
    {
        return $this->dateShipped;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set customer
     *
     * @param \ModelBundle\Entity\Customer $customer
     *
     * @return BookOrder
     */
    public function setCustomer(\ModelBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \ModelBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add item
     *
     * @param \ModelBundle\Entity\OrderItem $item
     *
     * @return BookOrder
     */
    public function addItem(\ModelBundle\Entity\OrderItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \ModelBundle\Entity\OrderItem $item
     */
    public function removeItem(\ModelBundle\Entity\OrderItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
