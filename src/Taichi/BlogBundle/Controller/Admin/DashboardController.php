<?php
namespace Taichi\BlogBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Taichi\BlogBundle\Controller\Controller;

/**
 * @Route("/admins")
 * @Security("has_role('ROLE_ADMIN')")
 */
class DashboardController extends Controller
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
}
