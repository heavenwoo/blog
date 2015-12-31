<?php

namespace Taichi\BlogBundle\Controller;

use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller  as BaseController;

class Controller extends BaseController
{
    /**
     * @return \Taichi\BlogBundle\Repository\UserRepository
     */
    protected function getUserRepository()
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('TaichiBlogBundle:User');
    }

    /**
     * @return \Taichi\BlogBundle\Repository\PostRepository
     */
    protected function getPostRepository()
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('TaichiBlogBundle:Post');
    }

    /**
     * @return \Taichi\BlogBundle\Repository\TagRepository
     */
    protected function getTagRepository()
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('TaichiBlogBundle:Tag');
    }

    /**
     * @return \Taichi\BlogBundle\Repository\CategoryRepository
     */
    protected function getCategoryRepository()
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('TaichiBlogBundle:Category');
    }

    /**
     * @return \Taichi\BlogBundle\Repository\CommentRepository
     */
    protected function getCommentRepository()
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('TaichiBlogBundle:Comment');
    }
}
