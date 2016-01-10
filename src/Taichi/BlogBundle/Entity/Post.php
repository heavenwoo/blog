<?php

namespace Taichi\BlogBundle\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="posts")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Taichi\BlogBundle\Repository\PostRepository")
 */
class Post extends Entity
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const PAGE_ITEMS = 10;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     * @Assert\NotBlank(message="The subject field should not be blank.")
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="string", length=255)
     * @Assert\NotBlank(message="The Summary field should not be blank.")
     */
    protected $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank(message="The Content field should not be blank.")
     * @Assert\Length(min = "10", minMessage = "The content is too short, 10 words is required at least.")
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_url", type="string", length=255, nullable=true)
     */
    protected $pictureUrl;

    /**
     * @ORM\ManyToOne(targetEntity="Taichi\UserBundle\Entity\User", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\NotBlank(message="The Category field should not be blank.")
     */
    protected $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(name="post_tags",
     *      joinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")}
     *      )
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    protected $comments;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Post
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Post
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
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
     * Set pictureUrl
     *
     * @param string $pictureUrl
     *
     * @return Post
     */
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * Get pictureUrl
     *
     * @return string
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * Set user
     *
     * @param \Taichi\BlogBundle\Entity\User $user
     *
     * @return Post
     */
    public function setUser(\Taichi\BlogBundle\Entity\User $user = null)
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
     * Set category
     *
     * @param \Taichi\BlogBundle\Entity\Category $category
     *
     * @return Post
     */
    public function setCategory(\Taichi\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Taichi\BlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add tag
     *
     * @param \Taichi\BlogBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\Taichi\BlogBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Taichi\BlogBundle\Entity\Tag $tag
     */
    public function removeTag(\Taichi\BlogBundle\Entity\Tag $tag)
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
     * Add comment
     *
     * @param \Taichi\BlogBundle\Entity\Comment $comment
     *
     * @return Post
     */
    public function addComment(\Taichi\BlogBundle\Entity\Comment $comment)
    {
        $this->comments->add($comment);
        $comment->setPost($this);

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Taichi\BlogBundle\Entity\Comment $comment
     */
    public function removeComment(\Taichi\BlogBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
        $comment->setPost(null);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
