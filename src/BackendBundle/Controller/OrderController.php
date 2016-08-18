<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 15.06.2016
 * Time: 18:39
 */

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $orderRepository = $em->getRepository('BackendBundle:Order');
        $orders = $orderRepository->findAll();

        $data = array('orders' => $orders);
        return $this->render('BackendBundle:Order:index.html.twig', $data);
    }

    public function orderDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orderRepository = $em->getRepository('BackendBundle:Order');
        $order = $orderRepository->find((int)$id);

        if ($order) {
            $data = array('order' => $order);
            return $this->render('BackendBundle:Order:detail.html.twig', $data);
        } else {
            throw $this->createNotFoundException('Не удалось найти такой заказ.');
        }
    }

    public  function changeStatusAction(Request $request, $id)
    {
        $success = 0;
        $message = '';

        $em = $this->getDoctrine()->getManager();
        $orderRepository = $em->getRepository('BackendBundle:Order');
        $order = $orderRepository->find((int)$id);

        if ($order) {
            $status = (int)$request->request->get('status', 0);
            $order->setStatus((int)$status);
            $em->persist($order);
            $em->flush();

            $success = 1;
            $message = $status;
        }else {
            $message = 'Такой заказ не найден';
            }

        $return = array(
            'message' => $message,
            'success' => $success
        );
        return new Response(json_encode($return));
    }
    
}