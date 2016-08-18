<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 15.06.2016
 * Time: 18:39
 */

namespace FrontendBundle\Controller;

use BackendBundle\Entity\Order;
use BackendBundle\Entity\OrderItem;
use FrontendBundle\Form\CheckoutForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class OrderController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->geManager();
        $user = $this->getUser();

        if($user) {
            return $this->render('FrontendBundle:Cart:index.html.twig', array('user' => $user));
        }
        return $this->render('FrontendBundle:Cart:index.html.twig');
    }

    public function formCheckoutAction(Request $request)
    {
        $checkout = new Order();
        $form = $this->createForm(new CheckoutForm(), $checkout, array(
            'action' => $this->generateUrl('frontend_order_confirm_page'),
            'method' => 'POST'
        ));

        return $this->render('FrontendBundle:Order:checkout.html.twig', array('form' => $form->createView()));

    }

    public function orderConfirmAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($user){
            if (count($user->getCartItems()) > 0) {
                $order = new Order();
                $form = $this->createForm(new CheckoutForm(), $order, array(
                    'method' => 'POST'
                ));

                $form->handleRequest($request);
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $order->setUser($user)
                        ->setCreated(new \DateTime());
                    $em->persist($order);
                    foreach ($user->getCartItems() as $cartItem){
                        $orderItem = new OrderItem();
                        $orderItem->setQuantity($cartItem->getQuantity())
                                ->setOrder($order)
                                ->setProduct($cartItem->getItem());
                        $em->persist($orderItem);
                        $em->remove($cartItem);
                    }
                    $em->flush();
                    return $this->render('FrontendBundle:Order:confirmed.html.twig');
                }
            }
        }
        return $this->redirect($this->generateUrl('home_page'));
    }

}