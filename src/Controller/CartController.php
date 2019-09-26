<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService, ProductRepository $productRepository)
    {
        return $this->render('cart/index.html.twig', [
            "items" => $cartService->getFullCart(),
            "total" => $cartService->getTotal()
        ]);
    }

    /**
     * @Route("/ajouter/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute("product_index");
    }

    /**
     * @Route("/supprimer/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute('cart_index');
    }
}
