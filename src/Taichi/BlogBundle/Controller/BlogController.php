<?php

namespace Taichi\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Taichi\BlogBundle\Entity\Category;
use Taichi\BlogBundle\Entity\Comment;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\Tag;
use Taichi\BlogBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Taichi\BlogBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
        $query = $this->getPostRepository()->findBy([], ['createdAt' => 'DESC']);

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
            'site' => $this->getSiteConfig(),
        ];
    }

    /**
     * @Route("/tag/{name}", name="blog_tag", defaults={"page" = 1})
     * @Route("/tag/{name}/page/{page}", name="blog_tag_paginated", requirements={"page" : "\d+"})
     * @Template()
     */
    public function tagAction($page, Tag $tag)
    {
        $query = $tag->getPosts();

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');

        $posts = $paginator->paginate($query, $page, Post::PAGE_ITEMS);

        $posts->setUsedRoute('blog_tag_paginated');

        return [
            'tag'   => $tag,
            'posts' => $posts,
            'site'  => $this->getSiteConfig(),
        ];
    }

    /**
     * @Route("/category/{name}", name="blog_category", defaults={"page" = 1})
     * @Route("/category/{name}/page/{page}", name="blog_category_paginated", requirements={"page" : "\d+"})
     * @Template()
     */
    public function categoryAction($page, Category $category)
    {
        $query = $category->getPosts();

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');

        $posts = $paginator->paginate($query, $page, Post::PAGE_ITEMS);

        $posts->setUsedRoute('blog_category_paginated');

        return [
            'category' => $category,
            'posts'    => $posts,
            'site'     => $this->getSiteConfig(),
        ];
    }

    /**
     * @Route("/comment/{postSlug}/new", name = "comment_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @Method("POST")
     * @ParamConverter("post", options={"mapping": {"postSlug": "slug"}})
     *
     * NOTE: The ParamConverter mapping is required because the route parameter
     * (postSlug) doesn't match any of the Doctrine entity properties (slug).
     * See
     * http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#doctrine-converter
     *
     * @Template()
     */
    public function commentAction(Post $post, Request $request)
    {
        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Comment $comment */
            $comment = $form->getData();
            $comment->setUser($this->getUser());
            $comment->setPost($post);
            $comment->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog_post', ['slug' => $post->getSlug()]);
        }

        return [
            'post' => $post,
            'form' => $form->createView(),
            'site' => $this->getSiteConfig(),
        ];
    }


    /**
     * This controller is called directly via the render() function in the
     * blog/post_show.html.twig template. That's why it's not needed to define
     * a route name for it.
     *
     * The "id" of the Post is passed in and then turned into a Post object
     * automatically by the ParamConverter.
     *
     * @param Post $post
     *
     * @return Response
     *
     * @Template("TaichiBlogBundle:Blog:_comment_form.html.twig")
     */
    public function commentFormAction(Post $post)
    {
        $form = $this->createForm(CommentType::class);

        return [
            'post' => $post,
            'form' => $form->createView(),
            'site' => $this->getSiteConfig(),
        ];
    }

    /**
     * @Route("/tag/add", name="tag_add")
     */
    public function addTagAction()
    {
        $em = $this->getDoctrine()->getManager();

        $i = 0;
        while ($i < 30) {
            $post = $this->getPostRepository()->findOneBy(['id' => ++$i]);

            for ($j = 0; $j < 10; $j++) {
                /** @var $tag \Taichi\BlogBundle\Entity\Tag */
                $tag = $this->getTagRepository()->findOneBy(['id' => $j + 1]);

                $post->addTag($tag);

                $em->persist($post);
                $em->flush();
            }
        }
    }
}
