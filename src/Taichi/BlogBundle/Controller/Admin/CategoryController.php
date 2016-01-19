<?php
namespace Taichi\BlogBundle\Controller\Admin;

use Taichi\BlogBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admins/category")
 * @Security("has_role('ROLE_ADMIN')")
 */
class CategoryController extends Controller
{

}
