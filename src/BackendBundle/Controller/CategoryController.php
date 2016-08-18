<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 23.05.2016
 * Time: 22:08
 */

namespace BackendBundle\Controller;

use BackendBundle\Entity\Category;
use BackendBundle\Form\CategoryForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository('BackendBundle:Category');
        $categories = $categoryRepository->findAll();

        $data = array('categories' => $categories);
        return $this->render('BackendBundle:Category:index.html.twig', $data);
    }

    public  function  deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository('BackendBundle:Category');
        $category = $categoryRepository->find((int)$id);
        if ($category) {
            $em->remove($category);
            $em->flush();
        } else {
            throw $this->createNotFoundException('Не удалось удалить, данная категория не найдена.');
        }

        return $this->redirect($this->generateUrl('admin_categories_page'));
    }

    public  function  formEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository('BackendBundle:Category');
        $category = $categoryRepository->find((int)$id);

        if (!$category) {
            throw $this->createNotFoundException('Не удалось найти такую категорию.');
        }

        $form = $this->createForm(new CategoryForm(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_categories_page'));
        }

        return $this->render('BackendBundle:Category:edit.html.twig',  array(
            'category' => $category,
            'form' => $form->createView(),
        ));

    }

    public function formCreateAction(Request $request)
    {

        $category = new Category();

        $form = $this->createForm(new CategoryForm(), $category);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('message', 'Новая категория сохранена!');

            return $this->redirect($this->generateUrl('admin_categories_page'));
        }

        return $this->render('BackendBundle:Category:create.html.twig', array('form' => $form->createView()));

    }
    
}
