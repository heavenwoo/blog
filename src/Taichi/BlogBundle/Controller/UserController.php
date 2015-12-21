<?php

namespace Taichi\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Taichi\BlogBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/{id}", requirements={
     *     "id": "[0-9]+"
     * })
     */
    public function indexAction($id)
    {
        return $this->render('TaichiBlogBundle:User:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/login")
     * @Method("GET")
     */
    public function loginAction()
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, ['label' => 'Username'])
            ->add('password', PasswordType::class, ['label' => 'Password'])
            ->add('login', SubmitType::class, ['label' => 'Login'])
            ->getForm();

        return $this->render('TaichiBlogBundle:User:login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->render('TaichiBlogBundle:User:logout.html.twig', array(
            // ...
        ));
    }

}
