<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Book;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\TagRepository")
 */
class Tag
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
     * @ORM\Column(name="tagName", type="string", length=50, unique=true)
     */
    private $tagName;


    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Book", mappedBy="tags")
     */
    private $books;

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
     * Set tagName
     *
     * @param string $tagName
     *
     * @return Tag
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * Get tagName
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add book
     *
     * @param \ModelBundle\Entity\Book $book
     *
     * @return Tag
     */
    public function addBook(\ModelBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \ModelBundle\Entity\Book $book
     */
    public function removeBook(\ModelBundle\Entity\Book $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
}
