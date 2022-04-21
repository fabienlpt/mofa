<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ArticleRepository $articleRepository): Response
    {
        if( $user = $this->getUser() ) {
            return $this->render('home/index.html.twig', [
                'roles' => $user->getRoles(),
                'articles' => $articleRepository ->findAll()
            ]);
        }
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository ->findAll()
        ]);
    }

    
    #[Route('/{search}', name: 'app_searchpage')]
    public function recherche(string $search, ArticleRepository $articleRepository): Response
    {           
        $articles = $articleRepository->findBySearch($search);

        if( $user = $this->getUser() ) {
            return $this->render('home/index.html.twig', [
                'user' => $user->getEmail(),
                'articles' => $articles
            ]);
        }
        return $this->render('home/index.html.twig', [
            'user' => 'anonyme',
            'search' => $search,
            'articles' => $articles
        ]);
    }
}
