<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CatalogueController extends AbstractController
{
    // Page du cataloguqe
    #[Route('/catalogue', name: 'catalogue')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération de tous les articles
        $articles = $entityManagerInterface->getRepository(Article::class)->findAll();

        // Récupération des genres
        $genres = $entityManagerInterface->getRepository(Genre::class)->findAll();

        return $this->render('catalogue/index.html.twig', [
            'articles' => $articles,
            'genres' => $genres
        ]);
    }
}
