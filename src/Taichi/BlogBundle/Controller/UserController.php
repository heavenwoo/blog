<?php

namespace Taichi\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Taichi\BlogBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        return $this->render('TaichiBlogBundle:User:index.html.twig', [
            // ...
        ]);
    }

    /**
     * @Route("/login")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->setAction($this->generateUrl('taichi_blog_user_login'))
            ->setMethod('POST')
            ->add('name', TextType::class, [
                'label' => 'Username',
                'attr'  => [
                    'placeholder' => 'Username',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'attr'  => [
                    'placeholder' => 'Password',
                ],
            ])
            ->add('login', SubmitType::class, [
                'label' => 'Login',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
        }

        return [
            'form' => $form->createView(),
            'site' => $this->getSiteConfig(),
        ];
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->render('TaichiBlogBundle:User:logout.html.twig', [
            // ...
        ]);
    }

}
