<?php

namespace Taichi\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Taichi\BlogBundle\Entity\Category;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 */
class BlogController extends Controller
{
    /**
     * @Route("/", name="blog_index", defaults={"page" = 1})
     * @Route("/page/{page}", name="blog_index_paginated", requirements={"page" : "\d+"})
     * @Template()
     */
    public function indexAction($page)
    {
//        $posts = $this->getPostRepository()->findAll();
        $query = $this->getPostRepository()->queryLatest();

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');

        $posts = $paginator->paginate($query, $page, Post::PAGE_ITEMS);

        $posts->setUsedRoute('blog_index_paginated');

        return [
            'posts' => $posts,
            'site'  => $this->getSiteConfig(),
        ];
    }

    /**
     * @Route("/post/{slug}", name="blog_post")
     * @Template()
     */
    public function postAction(Post $post)
    {
        return [
            'post' => $post,
            'site'  => $this->getSiteConfig(),
        ];
    }
}
