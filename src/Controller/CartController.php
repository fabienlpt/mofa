<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'cart_index')]
    public function index(SessionInterface $session, ArticleRepository $articleRepository): Response
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];

        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'article' => $articleRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($panierWithData as $item) {
            $total += $item['article'] ->getPrice() * $item['quantity'];
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    #[Route('/panier/add/{id}', name: 'cart_add')]
    public function add($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            ++$panier[$id];
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("app_homepage");
    }
    #[Route('/panier/remove/{id}', name: 'cart_remove')]
    public function remove($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        if($panier[$id] == 1) {
            unset($panier[$id]);
        }
        if(!empty($panier[$id])) {
            --$panier[$id];
        } 


        $session->set('panier', $panier);

        return $this->redirectToRoute("cart_index");
    }
}
