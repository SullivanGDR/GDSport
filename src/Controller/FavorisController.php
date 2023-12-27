<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FavorisController extends AbstractController
{
    // Page des favoris
    #[Route('/private-favoris', name: 'favoris')]
    public function favori(Request $request ,EntityManagerInterface $entityManagerInterface): Response
    {
        return $this->render('favoris/index.html.twig', [
        ]);
    }

    // Ajout d'un favoris
    #[Route('/private-favori', name: 'favori')]
    public function index(Request $request ,EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération de l'id de l'article
        $id = $request->get('id');

        // Récupération de l'action (ajouter ou supprimer le favori)
        $action = $request->get('action');

        // Récupérer la page sur laquelle l'utilisateur se trouve au moment de l'ajout du favori
        // afin qu'il reste au même endroit quand il ajoute un favori
        $page = $request->get('page');

        // Récupération de l'article
        $article = $entityManagerInterface->getRepository(Article::class)->find($id);
        
        // L'ajout d'un article dans les favoris depuis un catalogue
        if ($action == 'ajouter'){
            $this->getUser()->addFavori($article);
            $article->setNbFavoris($article->getNbFavoris()+1);
            $entityManagerInterface->persist($this->getUser());
            $entityManagerInterface->flush();
            return $this->redirectToRoute($page, array('_fragment' => $id, 'id' => $id));
        }

        // L'ajout d'un article dans les favoris depuis la page de l'article
        if ($action == 'ajouterArticle'){
            $this->getUser()->addFavori($article);
            $article->setNbFavoris($article->getNbFavoris()+1);
            $entityManagerInterface->persist($this->getUser());
            $entityManagerInterface->flush();
            return $this->redirectToRoute($page, array('id' => $id));
        }

        // Suppression d'un article dans les favoris depuis un catalogue
        if ($action == 'supprimer'){
            $this->getUser()->removeFavori($article);
            $article->setNbFavoris($article->getNbFavoris()-1);
            $entityManagerInterface->persist($this->getUser());
            $entityManagerInterface->flush();
            return $this->redirectToRoute($page, array('_fragment' => $id, 'id' => $id));
        }

        // Suppression d'un article dans les favoris depuis la page de favoris
        if ($action == 'supprimerFavoris'){
            $this->getUser()->removeFavori($article);
            $article->setNbFavoris($article->getNbFavoris()-1);
            $entityManagerInterface->persist($this->getUser());
            $entityManagerInterface->flush();
            return $this->redirectToRoute('favoris');
        }

        // Suppression d'un article dans les favoris depuis la page de l'article
        if ($action == 'supprimerArticle'){
            $this->getUser()->removeFavori($article);
            $article->setNbFavoris($article->getNbFavoris()-1);
            $entityManagerInterface->persist($this->getUser());
            $entityManagerInterface->flush();
            return $this->redirectToRoute($page, array('id' => $id));
        }
    }
}