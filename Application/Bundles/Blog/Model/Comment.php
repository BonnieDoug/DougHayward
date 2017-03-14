<?php

namespace Blog\Model;

use Core\Model;

/**
 * @Entity(repositoryClass="Blog\Model\Repository\CommentRepository")
 * @Table(name="comment")
 *
 */
class Comment extends Model
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /** @Column(type="text") */
    private $text;
    /**
     * Many Comments have One Author.
     * @ManyToOne(targetEntity="User", inversedBy="comments")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;
    /**
     * Many Comments have One Post.
     * @ManyToOne(targetEntity="Post", inversedBy="comments")
     * @JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;
    /** @Column(type="datetime", name="created_at") */
    private $createdAt;
    /** @Column(type="integer" length=1) */
    private $retired;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getRetired()
    {
        return $this->retired;
    }

    /**
     * @param mixed $retired
     */
    public function setRetired($retired)
    {
        $this->retired = $retired;
    }


}