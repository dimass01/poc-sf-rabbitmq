<?php
declare(strict_types = 1);

namespace AW\LeaveRequestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 * @package AW\LeaveRequestBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AWLeaveRequestBundle:Default:index.html.twig');
    }
}
