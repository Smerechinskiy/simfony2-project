<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 23.05.2016
 * Time: 22:08
 */

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        if ($user && !$user->isAdmin()) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        return $this->render('BackendBundle:Home:index.html.twig');
    }
}
