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
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        $comments = $this->getCommentRepository()->getCommentsCount();
        $posts = $this->getPostRepository()->getPostsCount();
        $users = $this->getUserRepository()->getUsersCount();
        $categories = $this->getCategoryRepository()->getCategoriesCount();
        $tags = $this->getTagRepository()->getTagsCount();

        $now = new \DateTime('now');

        $monthPosts = $monthComments = [];
        for ($i = 0; $i < 12; $i++) {
            $end = (new \DateTime())->setTimestamp(strtotime("-$i month", $now->getTimestamp()));
            $begin = (new \DateTime())->setTimestamp(strtotime("-1 month", $end->getTimestamp()));

            $rs = $this->getPostRepository()->getPostsPerMonth($begin, $end);
            $monthPosts[] = $rs[0][1];

            $rs = $this->getCommentRepository()->getCommentsPerMonth($begin, $end);
            $monthComments[] = $rs[0][1];
        }

        return $this->render('TaichiBlogBundle:Admin/Blog:dashboard.html.twig', [
            'posts'         => $posts,
            'comments'      => $comments,
            'users'         => $users,
            'categories'    => $categories,
            'tags'          => $tags,
            'monthPosts'    => implode(',', $monthPosts),
            'monthComments' => implode(',', $monthComments),
        ]);
    }
}
