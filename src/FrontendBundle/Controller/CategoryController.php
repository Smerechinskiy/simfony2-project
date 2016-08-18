<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 23.05.2016
 * Time: 22:08
 */

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function categoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository('BackendBundle:Category');
        $category = $categoryRepository->find((int)$id);

        $products = $em->getRepository('BackendBundle:Product')->findBy(array('category' => $category));

        $data = array('products' => $products, 'category' => $category);
        return $this->render('FrontendBundle:Category:index.html.twig', $data);
    }
    
}
