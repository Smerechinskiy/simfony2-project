<?php
namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExportController extends Controller
{

    public function exportOrdersAction()
    {
        $repository = $this->getDoctrine()->getRepository('BackendBundle:Order');
        $query = $repository->createQueryBuilder('s');
        $query->orderBy('s.id', 'DESC');

        if ($query){
            $data = $query->getQuery()->getResult(); $filename = "export_orders_".date("(d-m-Y_H:i:s)").".csv";

            $response = $this->render('BackendBundle:Export:orders.html.twig', array('data' => $data));
            $response->headers->set('Content-Type', 'text/csv');

            $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
            return $response;
        } else {
            throw $this->createNotFoundException('На данный момент нет заказов для экспорта.');
        }
    }

    public function exportProductsAction()
    {
        $repository = $this->getDoctrine()->getRepository('BackendBundle:Category');
        $query = $repository->createQueryBuilder('s');
        $query->orderBy('s.id', 'DESC');

        if ($query){
            $data = $query->getQuery()->getResult(); $filename = "export_products_".date("(d-m-Y_H:i:s)").".csv";

            $response = $this->render('BackendBundle:Export:products.html.twig', array('data' => $data));
            $response->headers->set('Content-Type', 'text/csv');

            $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);
            return $response;
        } else {
            throw $this->createNotFoundException('На данный момент нет товаров для экспорта.');
        }
    }

}

