<?php

namespace Taichi\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Taichi\BlogBundle\Repository\CommentRepository")
 */
class Comment extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank(message="The subject field should not be blank.")
     * @Assert\Length(min = "10", minMessage = "The content is too short, 10 words is required at least.")
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="Taichi\UserBundle\Entity\User", inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $post;

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set user
     *
     * @param \Taichi\BlogBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(\Taichi\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Taichi\BlogBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post
     *
     * @param \Taichi\BlogBundle\Entity\Post $post
     *
     * @return Comment
     */
    public function setPost(\Taichi\BlogBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Taichi\BlogBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
