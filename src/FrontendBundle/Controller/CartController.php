<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 15.06.2016
 * Time: 18:39
 */

namespace FrontendBundle\Controller;

use BackendBundle\Entity\CartItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if($user) {
            return $this->render('FrontendBundle:Cart:index.html.twig', array('user' => $user));
        }
        return $this->render('FrontendBundle:Cart:index.html.twig');
    }

    public function addToCartAction($id)
    {
        $success = 0;
        $message = '';
        $count = 0;

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if($user) {
            $productRepository = $em->getRepository('BackendBundle:Product');
            $product = $productRepository->find((int)$id);

            if ($product) {
                $cartItemRepository = $em->getRepository('BackendBundle:CartItem');
                $cartItem = $cartItemRepository->findOneBy(array('user' => $user, 'item' => $product));
                if ($cartItem){
                    $cartItem->setQuantity($cartItem->getQuantity() + 1);
                } else {
                    $cartItem = new CartItem();
                    $cartItem->setQuantity(1)
                         ->setItem($product)
                         ->setUser($user);
                }
                $em->persist($cartItem);
                $em->flush();
                $count = count($user->getCartItems());

                $success = 1;
                $message = 'Продукт добавлен в корзину';
            } else{
                $message = 'Продукт не найден';
            }
        } else{
            $success = 2;
        }
        $return = array(
            'message' => $message,
            'success' => $success,
            'count' => $count
        );

        return new Response(json_encode($return));
    }

    public  function  deleteOfCartAction(Request $request, $id)
    {
        $success = 0;
        $message = '';
        $amount = 0;
        $count = 0;

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            $itemRepository = $em->getRepository('BackendBundle:CartItem');
            $item = $itemRepository->find((int)$id);
            if ($item) {
                $em->remove($item);
                $em->flush();

                foreach ( $user->getCartItems() as $cartItem) {
                    $amount += $cartItem->getQuantity()*$cartItem->getItem()->getPrice();
                }

                $count = count($user->getCartItems());
                $success = 1;
            }else {
                $message = 'Ошибка удаления';
            }
        } else {
            $message = 'Вы не авторизированы, авторизируйтесь!';
        }
        $return = array(
            'message' => $message,
            'success' => $success,
            'amount' => $amount,
            'count' => $count
        );

        return new Response(json_encode($return));
    }

    public  function changeQuantityAction(Request $request, $id)
    {
        $success = 0;
        $message = '';
        $amount = 0;

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            $itemRepository = $em->getRepository('BackendBundle:CartItem');
            $item = $itemRepository->findOneBy(array('id' => (int)$id, 'user' => $user));

            if ($item) {
                $quantity = (int)$request->get('quantity');
                if ($quantity > 0) {
                    $item->setQuantity($quantity);
                    $em->persist($item);
                    $em->flush();

                    foreach ( $user->getCartItems() as $cartItem) {
                        $amount += $cartItem->getQuantity()*$cartItem->getItem()->getPrice();
                    }

                    $success = 1;
                }else {
                    $message = 'Неверное кол-во';
                }

            }else {
                $message = 'Такой продукт не найден';
            }
        }else {
            $message = 'Вы не авторизированы, авторизируйтесь!';
        }
        $return = array(
            'message' => $message,
            'success' => $success,
            'amount' => $amount
        );

        return new Response(json_encode($return));
    }
}