<?php

namespace ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="commentText", type="text")
     * @Assert\NotBlank(message="Vous devez saisir un message")
     */
    private $commentText;

    /**
     * @var string
     *
     * @ORM\Column(name="authorEmail", type="string", length=50)
     * @Assert\NotBlank(message="Vous devez saisir une adresse e-mail")
     * @Assert\Email(message="Votre adresse e-mail est invalide")
     */
    private $authorEmail;

    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="comments")
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Comment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set commentText
     *
     * @param string $commentText
     *
     * @return Comment
     */
    public function setCommentText($commentText)
    {
        $this->commentText = $commentText;

        return $this;
    }

    /**
     * Get commentText
     *
     * @return string
     */
    public function getCommentText()
    {
        return $this->commentText;
    }

    /**
     * Set authorEmail
     *
     * @param string $authorEmail
     *
     * @return Comment
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }

    /**
     * Get authorEmail
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Set book
     *
     * @param \ModelBundle\Entity\Book $book
     *
     * @return Comment
     */
    public function setBook(\ModelBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \ModelBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }
}
