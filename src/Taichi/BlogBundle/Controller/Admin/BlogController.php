<?php

namespace Taichi\BlogBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Taichi\BlogBundle\Controller\Controller;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Form\PostType;

/**
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class BlogController extends Controller
{
    /**
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboardAction()
    {
        $posts = $this->getPostRepository()->findAll();
        $comments = $this->getCommentRepository()->findAll();
        $users = $this->getUserRepository()->findAll();
        $categories = $this->getCategoryRepository()->findAll();
        $tags = $this->getTagRepository()->findAll();

        return $this->render('TaichiBlogBundle:Admin/Blog:dashboard.html.twig', [
            'posts'      => $posts,
            'comments'   => $comments,
            'users'      => $users,
            'categories' => $categories,
            'tags'       => $tags,
        ]);
    }

    /**
     * @Route("/post/list", name="admin_post_list")
     */
    public function listAction()
    {
        return $this->render('TaichiBlogBundle:Admin/Blog:list.html.twig', [
            'posts' => $this->getPostRepository()->getAllPosts(),
        ]);
    }

    /**
     * @Route("/post/create", name="admin_post_create")
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

            $this->addFlash('success', 'post.created_successfully');

            if ($form->get('saveAndCreateNew')->isClicked()) {
                return $this->redirectToRoute('admin_post_create');
            }

            return $this->redirectToRoute('admin_post_list');
        }

        return $this->render('TaichiBlogBundle:Admin/Blog:create.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Post    $post
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/post/{id}/edit", methods={"GET", "POST"}, requirements={"id" = "\d+"}, name="admin_post_edit")
     */
    public function editAction(Post $post, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $editForm = $this->createForm(PostType::class, $post);
        $deleteForm = $this->createDeleteForm($post);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();

            $this->addFlash('success', 'post.updated_successfully');

            return $this->redirectToRoute('admin_post_edit', ['id' => $post->getId()]);
        }

        return $this->render('TaichiBlogBundle:Admin/Blog:edit.html.twig', [
            'post'        => $post,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * @param Post $post
     * @return array
     *
     * @Route("/post/{id}", methods={"GET"}, requirements={"id" = "\d+"}, name="admin_post_show")
     */
    public function showAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('TaichiBlogBundle:Admin/Blog:show.html.twig', [
            'post'        => $post,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param Post    $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/post/{id}", methods={"DELETE"}, name="admin_post_delete")
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
