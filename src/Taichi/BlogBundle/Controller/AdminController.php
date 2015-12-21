<?php

namespace Taichi\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('TaichiBlogBundle:Admin:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->render('TaichiBlogBundle:Admin:Login.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->render('TaichiBlogBundle:Admin:Logout.html.twig', array(
            // ...
        ));
    }

}
