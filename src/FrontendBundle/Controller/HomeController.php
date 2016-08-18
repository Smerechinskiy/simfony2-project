<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackendBundle\Entity\Cart;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBundle:Home:index.html.twig');
    }

    public function topmenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository('BackendBundle:Category');
        $categories = $categoryRepository->findAll();

        $data = array('categories' => $categories);
        return $this->render('FrontendBundle:Home:topmenu.html.twig', $data);
    }

    public function cartAction()
    {
        $user = $this->getUser();
        $data = array();
        if ($user) {
            $data['user'] = $user;
        }
        return $this->render('FrontendBundle:Home:cart.html.twig', $data);
    }

    public function loginAction()
    {
        $user = $this->getUser();
        $data = array();
        if ($user) {
            $data['user'] = $user;
        }
        return $this->render('FrontendBundle:Home:login.html.twig', $data);
    }
}
