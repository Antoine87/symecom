<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Publisher;
use ModelBundle\Entity\Author;
use ModelBundle\Entity\Tag;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\BookRepository")
 */
class Book
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=120)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublished", type="date", nullable=true)
     */
    private $datePublished;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;


    /**
     * @var Publisher
     * @ORM\ManyToOne(targetEntity="Publisher")
     */
    private $publisher;

    /**
     * @var Author
     * @ORM\ManyToOne(targetEntity="Author")
     */
    private $author;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="books")
     */
    private $tags;


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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Book
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set datePublished
     *
     * @param \DateTime $datePublished
     *
     * @return Book
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Get datePublished
     *
     * @return \DateTime
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     *
     * @return Book
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set publisher
     *
     * @param \ModelBundle\Entity\Publisher $publisher
     *
     * @return Book
     */
    public function setPublisher(\ModelBundle\Entity\Publisher $publisher = null)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return \ModelBundle\Entity\Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set author
     *
     * @param \ModelBundle\Entity\Author $author
     *
     * @return Book
     */
    public function setAuthor(\ModelBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \ModelBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add tag
     *
     * @param \ModelBundle\Entity\Tag $tag
     *
     * @return Book
     */
    public function addTag(\ModelBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \ModelBundle\Entity\Tag $tag
     */
    public function removeTag(\ModelBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set cartItems
     *
     * @param \ModelBundle\Entity\CartItem $cartItems
     *
     * @return Book
     */
    public function setCartItems(\ModelBundle\Entity\CartItem $cartItems = null)
    {
        $this->cartItems = $cartItems;

        return $this;
    }

    /**
     * Get cartItems
     *
     * @return \ModelBundle\Entity\CartItem
     */
    public function getCartItems()
    {
        return $this->cartItems;
    }

    /**
     * Set orderItems
     *
     * @param \ModelBundle\Entity\OrderItem $orderItems
     *
     * @return Book
     */
    public function setOrderItems(\ModelBundle\Entity\OrderItem $orderItems = null)
    {
        $this->orderItems = $orderItems;

        return $this;
    }

    /**
     * Get orderItems
     *
     * @return \ModelBundle\Entity\OrderItem
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }
}
