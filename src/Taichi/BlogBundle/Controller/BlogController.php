<?php
namespace Taichi\BlogBundle\Controller;

use Taichi\BlogBundle\Entity\Tag;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\Comment;
use Taichi\BlogBundle\Entity\Category;
use Taichi\BlogBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Cache(expires="1 hour")
 */
class BlogController extends Controller
{
    /**
     * Index listing
     * @Route("/", name="blog_index", defaults={"page" = 1}, options={"sitemap" = true})
     * @Route("/page/{page}", name="blog_index_paginated", requirements={"page" : "\d+"})
     *
     * @param $page
     * @return Response
     */
    public function indexAction($page)
    {
        return $this->listAction($page);
    }

    /**
     * Category listing
     * @Route("/category/{name}", name="blog_category", defaults={"page" = 1})
     * @Route("/category/{name}/page/{page}", name="blog_category_paginated", requirements={"page" : "\d+"})
     *
     * @param          $page
     * @param Category $category
     * @return Response
     */
    public function categoryAction($page, Category $category)
    {
        return $this->listAction($page, null, $category);
    }

    /**
     * Tag listing
     * @Route("/tag/{name}", name="blog_tag", defaults={"page" = 1})
     * @Route("/tag/{name}/page/{page}", name="blog_tag_paginated", requirements={"page" : "\d+"})
     *
     * @param     $page
     * @param Tag $tag
     * @return Response
     */
    public function tagAction($page, Tag $tag)
    {
        return $this->listAction($page, $tag);
    }

    /**
     * @param               $page
     * @param Tag|null      $tag
     * @param Category|null $category
     * @return Response
     */
    public function listAction($page, Tag $tag = null, Category $category = null)
    {
        if ($tag !== null) {
            $query = $tag->getPosts();
            $route = 'tag';
        } else if ($category !== null) {
            $query = $category->getPosts();
            $route = 'category';
        } else {
            $query = $this->getPostRepository()->findBy([], ['createdAt' => 'DESC']);
            $route = 'index';
        }

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');

        /** @var \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination $posts */
        $posts = $paginator->paginate($query, $page, Post::PAGE_ITEMS);

        $posts->setUsedRoute("blog_{$route}_paginated");

        return $this->render('TaichiBlogBundle:Blog:index.html.twig', [
            'posts' => $posts,
            'tag' => $tag,
            'category' => $category,
        ]);
    }

    /**
     * @Route("/post/{id}", name="blog_post")
     *
     * @param Post $post
     * @return Response
     */
    public function postAction(Post $post)
    {
        return $this->render('TaichiBlogBundle:Blog:post.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/comment/{postId}/new", methods={"POST"}, name = "comment_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @ParamConverter("post", options={"mapping": {"postId": "id"}})
     *
     * NOTE: The ParamConverter mapping is required because the route parameter
     * (postId) doesn't match any of the Doctrine entity properties (id).
     * See
     * http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#doctrine-converter
     *
     * @param Post    $post
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog_post', ['id' => $post->getId()]);
        }

        return $this->render('TaichiBlogBundle:Blog:comment.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * This controller is called directly via the render() function in the
     * Blog/post.html.twig template. That's why it's not needed to define
     * a route name for it.
     *
     * The "id" of the Post is passed in and then turned into a Post object
     * automatically by the ParamConverter.
     *
     * @param Post $post
     *
     * @return Response
     */
    public function commentFormAction(Post $post)
    {
        $form = $this->createForm(CommentType::class);

        return $this->render('TaichiBlogBundle:Blog:_comment_form.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
