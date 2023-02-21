<?php

namespace App\Controller;

use App\Cart\Cart;
use App\Entity\Product;
use App\Form\CartRowType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(
        Request $request,
        ProductRepository $productRepository,
    ): Response
    {
        $session = $request->getSession();
        $cart = $this->getCart($session);

        $form = $this->createForm(CartRowType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $product = $productRepository->find($data['product_id']);

            if (!$product) {
                throw new \InvalidArgumentException('no product with this id');
            }

            $cart->add($product, $data['quantity']);

            return $this->redirectToRoute('app_cart');
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/cart/{id}', methods:[ 'DELETE' ])]
    public function deleteRow(
        Product $product,
        SessionInterface $session,
        ): JsonResponse
    {
        $cart = $this->getCart($session);
        $cart->removeRow($product);

        return new JsonResponse([
            'totalQuantity' => $cart->countTotalProducts(),
        ]);
    }

    #[Route('/cart/{id}/increment', methods:[ 'DELETE' ])]
    public function incrementRow(
        Product $product,
        SessionInterface $session,
        ): JsonResponse
    {
        $cart = $this->getCart($session);
        $cartRow = $cart->getRow($product);
        $cartRow->add(1);

        return new JsonResponse([
            'rowQuantity' => $cartRow->getQuantity(),
            'totalQuantity' => $cart->countTotalProducts(),
        ]);
    }

    private function getCart(SessionInterface $session): Cart
    {
        if (!$session->has('cart')) {
            $session->set('cart', new Cart());
        }

        /** @var Cart */
        return $session->get('cart');
    }
}
