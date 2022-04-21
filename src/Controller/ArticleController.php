<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'app_article')]
    public function index(Article $article): Response
    {
        return $this->render('article/index.html.twig', [
            'article' => $article
        ]);
    }


    #[Route('/new_article', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article)->handleRequest($request);
        
        if($form -> isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();
        }
        return $this->render('article/new_article.html.twig', [
            'form' => $form -> createView()
        ]);
    }


    #[Route('/delete/{id}', name: 'article_delete')]
    public function delete(Article $article, EntityManagerInterface $em): Response
    {
        $em -> remove($article);
        $em -> flush();

        return $this->redirectToRoute('app_homepage');
    }
}
