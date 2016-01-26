<?php
namespace Taichi\BlogBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Taichi\BlogBundle\Controller\Controller;

/**
 * @Route("/admins/dashboard")
 * @Security("has_role('ROLE_ADMIN')")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/", name="admin_dashboard")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        return $this->render('TaichiBlogBundle:Admin/Blog:dashboard.html.twig',
            array_merge($this->getItemCounts(), $this->getItemsPerMonth())
        );
    }

    /**
     * @Route("/items", name="admin_dashboard_items")
     * @Cache(public=true,expires="+10 mins", smaxage=600, maxage=600)
     *
     * @return array
     */
    public function getItemCounts()
    {
        $comments = $this->getCommentRepository()->getCommentsCount()[0][1];
        $posts = $this->getPostRepository()->getPostsCount()[0][1];
        $users = $this->getUserRepository()->getUsersCount()[0][1];
        $categories = $this->getCategoryRepository()->getCategoriesCount()[0][1];
        $tags = $this->getTagRepository()->getTagsCount()[0][1];

        return compact('posts', 'comments', 'users', 'categories', 'tags');
    }

    /**
     * @Route("/mitems", name="admin_dashboard_mitems")
     * @Cache(public=true,expires="+1 hour", smaxage=600, maxage=600)
     *
     * @return array
     */
    public function getItemsPerMonth()
    {
        $now = new \DateTime('now');

        $monthPosts = $monthComments = [];
        for ($i = 0; $i < 12; $i++) {
            $end = (new \DateTime())->setTimestamp(strtotime("-$i month", $now->getTimestamp()));
            $begin = (new \DateTime())->setTimestamp(strtotime("-1 month", $end->getTimestamp()));

            $monthPosts[] = $this->getPostRepository()->getPostsPerMonth($begin, $end)[0][1];
            $monthComments[] = $this->getCommentRepository()->getCommentsPerMonth($begin, $end)[0][1];
        }

        return compact('monthPosts', 'monthComments');
    }
}
