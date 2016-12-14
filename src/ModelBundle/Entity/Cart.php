<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\CartItem;
use ModelBundle\Entity\Customer;

/**
 * Cart
 *
 * @ORM\Table(name="cart")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\CartRepository")
 */
class Cart
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
     * @var Customer
     * @ORM\OneToOne(targetEntity="Customer")
     */
    private $customer;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart")
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
     * @return Cart
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
     * @param \ModelBundle\Entity\CartItem $item
     *
     * @return Cart
     */
    public function addItem(\ModelBundle\Entity\CartItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \ModelBundle\Entity\CartItem $item
     */
    public function removeItem(\ModelBundle\Entity\CartItem $item)
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
