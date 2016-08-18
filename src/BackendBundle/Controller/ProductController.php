<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 23.05.2016
 * Time: 22:08
 */

namespace BackendBundle\Controller;

use BackendBundle\Entity\Product;
use BackendBundle\Form\ProductForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('BackendBundle:Product');
        $products = $productRepository->findAll();

        $data = array('products' => $products);
        return $this->render('BackendBundle:Product:index.html.twig', $data);
    }

    public  function  deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('BackendBundle:Product');
        $product = $productRepository->find((int)$id);
        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_products_page'));
    }

    public  function  formEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('BackendBundle:Product');
        $product = $productRepository->find((int)$id);

        if (!$product) {
            throw $this->createNotFoundException('Не удалось найти такой продукт.');
        }

        $form = $this->createForm(new ProductForm(), $product);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($product);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_products_page'));
        }

        return $this->render('BackendBundle:Product:edit.html.twig',  array(
            'product' => $product,
            'form' => $form->createView(),
        ));

    }

    public function formCreateAction(Request $request)
    {

        $product = new Product();

        $form = $this->createForm(new ProductForm(), $product);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('message', 'Новый продукт сохранен!');

            return $this->redirect($this->generateUrl('admin_products_page'));
        }

        return $this->render('BackendBundle:Product:create.html.twig', array('form' => $form->createView()));

    }
}
