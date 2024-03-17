<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class TousArticlesController extends AbstractController
{
    #[Route('/tous/articles', name: 'tous-articles')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $tousArticles = $entityManagerInterface->getRepository(Article::class)->findAll();

        return $this->render('tous_articles/index.html.twig', [
            'tousArticles' => $tousArticles
        ]);
    }
}
