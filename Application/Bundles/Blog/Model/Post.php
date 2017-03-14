<?php

namespace Blog\Model;

use Core\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="Blog\Model\Repository\PostRepository")
 * @Table(name="post")
 *
 */
class Post extends Model
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /** @Column(type="string" length=140) */
    private $name;
    /** @Column(type="text") */
    private $description;
    /** @Column(length=140) */
    private $slug;
    /**
     * Many Posts have One Author.
     * @ManyToOne(targetEntity="User", inversedBy="posts")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;
    /** @Column(type="datetime", name="created_at") */
    private $createdAt;
    /** @Column(type="datetime", name="updated_at") */
    private $updatedAt;
    /** @Column(type="integer" length="1") */
    private $retired;
    /**
     * One Post has Many Comments.
     * @OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return object
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param integer $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return integer
     */
    public function getRetired()
    {
        return $this->retired;
    }

    /**
     * @param integer $retired
     */
    public function setRetired($retired)
    {
        $this->retired = $retired;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }


}