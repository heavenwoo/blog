<?php

namespace Taichi\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Taichi\BlogBundle\Entity\Category;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $site_name = $this->getParameter('site_name');

        return $this->render('TaichiBlogBundle:Default:index.html.twig', compact('site_name'));
    }

    /**
     * @Route("/post/{id}")
     * @ParamConverter("book", class="TaichiBlogBundle:Post")
     */
    public function showPostAction(Post $post)
    {
        return new Response($post->getSubject());
    }

    /**
     *
     * @Route("/blog/{slug}")
     * @param $slug
     * @return Response
     */
    public function showAction($slug)
    {
        return new Response($slug);
    }
}
