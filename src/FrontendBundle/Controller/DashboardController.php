<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $data = array();
        if ($user) {
            $data = array('user'=> $user);
        }
        return $this->render('FrontendBundle:Dashboard:index.html.twig', $data);
    }

    public function orderDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orderRepository = $em->getRepository('BackendBundle:Order');
        $order = $orderRepository->find((int)$id);

        if ($order) {
            $data = array('order' => $order);
            return $this->render('FrontendBundle:Dashboard:orderDetail.html.twig', $data);
        } else {
            throw $this->createNotFoundException('Не удалось найти такой заказ.');
        }
    }

}
