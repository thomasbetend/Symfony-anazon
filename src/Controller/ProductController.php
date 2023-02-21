<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CartRowType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{slug}', name: 'app_product')]
    public function show(Product $product): Response
    {
        $form = $this->createForm(CartRowType::class, [
                'product_id' => $product->getId(),
            ], [
                'action' => $this->generateUrl('app_cart'),
            ]
        );
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }
}
