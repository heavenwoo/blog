<?php

namespace Taichi\BlogBundle\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\HasLifecycleCallbacks
 */
class Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Category
     */
    public function setCreatedAt(Carbon $createdAt)
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Category
     */
    public function setUpdatedAt(Carbon $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function PrePersist()
    {
        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(Carbon::now());
        }

        $this->setUpdatedAt(Carbon::now());
    }

    /**
     * @ORM\PreUpdate()
     */
    public function PreUpdate()
    {
        $this->setUpdatedAt(Carbon::now());
    }
}