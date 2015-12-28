<?php

namespace Taichi\BlogBundle\Controller\Admin;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Taichi\BlogBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Taichi\BlogBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\Tag;
use Taichi\BlogBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class BlogController extends Controller
{
    /**
     * @Route("/dashboard", name="admin_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
        $posts = $this->getPostRepository()->findAll();
        $comments = $this->getCommentRepository()->findAll();
        $users = $this->getUserRepository()->findAll();
        $categories = $this->getCategoryRepository()->findAll();
        $tags = $this->getTagRepository()->findAll();

        return [
            'posts'      => $posts,
            'comments'   => $comments,
            'users'      => $users,
            'categories' => $categories,
            'tags'       => $tags,
        ];
    }

    /**
     * @Route("/post/list", name="admin_post_list")
     * @Template()
     */
    public function listAction()
    {
        return [
            'posts' => $this->getPostRepository()->findAll(),
        ];
    }

    /**
     * @Route("/post/create", name="admin_post_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'Post updated successfully');

            if ($form->get('saveAndCreateNew')->isClicked()) {
                return $this->redirectToRoute('admin_post_create');
            }

            return $this->redirectToRoute('admin_post_list');
        }

        return [
            'post' => $post,
            'form' => $form->createView(),
            'site' => $this->getSiteConfig(),
        ];
    }

    /**
     * @param Post $post
     * @return array
     *
     * @Route("/post/{id}", requirements={"id" = "\d+"}, name="admin_post_show")
     * @Template()
     * @Method("GET")
     */
    public function showAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return [
            'post'        => $post,
            'delete_form' => $deleteForm->createView(),
            'site'        => $this->getSiteConfig(),
        ];
    }

    /**
     * @param Post    $post
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/post/{id}/edit", requirements={"id" = "\d+"}, name="admin_post_edit")
     * @Template()
     * @Method({"GET", "POST"})
     */
    public function editAction(Post $post, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $editForm = $this->createForm(PostType::class, $post);
        $deleteForm = $this->createDeleteForm($post);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Post updated successfully');

            return $this->redirectToRoute('admin_post_edit', ['id' => $post->getId()]);
        }

        return [
            'post'        => $post,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'site'        => $this->getSiteConfig(),
        ];
    }

    /**
     * @param Request $request
     * @param Post    $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/post/{id}", name="admin_post_delete")
     * @Method("DELETE")
     *
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($post->getComments() as $comment) {
                $em->remove($comment);
            }

            $em->remove($post);
            $em->flush();

            $this->addFlash('success', 'Post deleted successfully.');
        }

        return $this->redirectToRoute('admin_post_list');
    }

    /**
     * @param Post $post
     * @return \Symfony\Component\Form\Form
     */
    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_post_delete', ['id' => $post->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
