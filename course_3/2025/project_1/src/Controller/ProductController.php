<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product', methods:["GET"])]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render(
            'product/index.html.twig',
            ['products' => $products]
        );
    }

    #[Route('/product/create', name: 'create_product_page', methods:['GET'])]
    public function createProductPage(): Response
    {
        return $this->render('product/createProduct.html.twig');
    }

    #[Route('/product/create', name: 'create_product', methods: ['POST'])]
    public function createProduct(EntityManagerInterface $em, Request $request): Response
    {
        $product = new Product();

        $product->setName($request->request->get('name'));
        $product->setCount($request->request->get('count'));
        $product->setPrice($request->request->get('price'));

        $em->persist($product);

        $em->flush();

        return $this->redirect('/product');
    }

    #[Route('/product/edit/{product}', name: 'edit_page_product', methods: ['POST'])]
    public function editPageProduct(Product $product): Response
    {
        return $this->render('product/edit.html.twig',
        ['product' => $product]);
    }

    #[Route('/product/edit/{product}', name: 'edit_product', methods: ['PUT'])]
    public function edit(Product $product, Request $request, EntityManagerInterface $em): Response
    {
        $product->setName($request->request->get('name'));
        $product->setCount($request->request->get('count'));
        $product->setPrice($request->request->get('price'));

        $em->flush();

        return $this->redirect('/product');
    }

    #[Route('/product/delete/{product}', name: 'delete_product', methods: ["DELETE"])]
    public function deleteProduct(Product $product, EntityManagerInterface $em): Response
    {
        $em->remove($product);

        $em->flush();

        return $this->redirect('/product');
    }
}
