<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Panier;
use App\Entity\Ajouter;
use App\Entity\ArticleTaille;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class PanierController extends AbstractController
{
    // Page du panier
    #[Route('/private-panier', name: 'panier')]
    public function index(Request $request , EntityManagerInterface $entityManagerInterface): Response
    {
        // Si l'utilisateur n'a pas de panier, on en créer un
        if ($this->getUser()->getPanier() == NULL) {
            $this->getUser()->setPanier(new Panier());
            $entityManagerInterface->persist($this->getUser());
            $entityManagerInterface->flush();
        } 
        
        return $this->render('panier/index.html.twig', [
        ]);
    }

    // Page de modification du panier
    #[Route('/private-edit-panier', name: 'editpanier')]
    public function edit_panier(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        // Récupération de l'id de l'article
        $id = $request->get('id');

        // Récupération de sa taille
        if ($request->isMethod('POST')) {
            $taille = $request->get('taille');
            $tailleArticle = $entityManagerInterface->getRepository(ArticleTaille::class)->find($taille);
            $tailleValue = $tailleArticle->getTaille();
        }

        // Récupération de la page
        $page = $request->get('page');

        // Récupération de l'action (ajouter, supprimer..)
        $action = $request->get('action');

        // Récupération du panier du user
        $panier = $this->getUser()->getPanier();

        // Récupération des produits du panier
        $produits = $panier->getAjouters();

        // Récupération d'un article déjà présent dans le panier dans le cas d'un changement de quantité
        $ajouter = $entityManagerInterface->getRepository(Ajouter::class)->find($id);

        // Récupération de l'article à ajouter (dans le cas d'un ajout)
        $article = $entityManagerInterface->getRepository(Article::class)->find($id);

        // Ajout d'un article au panier
        if ($action == 'ajouter') {
            // Cas où l'utilisateur n'a pas de panier
            if ($this->getUser()->getPanier() == null) {
                $this->getUser()->setPanier(new Panier());
                $entityManagerInterface->persist($this->getUser());
                $entityManagerInterface->flush();
                $new_ajout = new Ajouter;
                $new_ajout->setPanier($panier);
                $new_ajout->setQuantite(1);
                $new_ajout->setTaille($tailleValue);
                $new_ajout->setProduit($article);
                $tailleArticle->setQuantite($tailleArticle->getQuantite() - 1);
                $entityManagerInterface->persist($new_ajout);
                $entityManagerInterface->persist($tailleArticle);
            } 

            // Récupération de l'article à ajouter
            $existeAjouter = $entityManagerInterface->getRepository(Ajouter::class)->findOneBy([
                'panier' => $panier,
                'produit' => $article,
                'taille' => $tailleValue,
            ]);

            // Si l'article est déjà présent dans le panier, et que l'utilisateur l'ajoute de nouveau
            // on augmente sa quantité et réduit le stock de l'article
            if ($existeAjouter){
                $existeAjouter->setQuantite($existeAjouter->getQuantite() + 1);
                $tailleArticle->setQuantite($tailleArticle->getQuantite() - 1);
                $entityManagerInterface->persist($tailleArticle);
                $entityManagerInterface->persist($existeAjouter);
            } else {
                // Si l'article n'est pas présent dans le panier, on l'ajoute simplement
                $new_ajout = new Ajouter;
                $new_ajout->setPanier($panier);
                $new_ajout->setQuantite(1);
                $new_ajout->setTaille($tailleValue);
                $new_ajout->setProduit($article);
                $tailleArticle->setQuantite($tailleArticle->getQuantite() - 1);
                $entityManagerInterface->persist($tailleArticle);
                $entityManagerInterface->persist($new_ajout);
            }
        }
        
        // Suppression d'un article dans le panier
        if ($action == 'supprimer') {
            $tailleA = $ajouter->getTaille();
            $article2 = $ajouter->getProduit();
            $articleTaille = $entityManagerInterface->getRepository(ArticleTaille::class)->findOneBy([
                'article' => $article2,
                'taille' => $tailleA,
            ]);
            
            // Permet de récupérer la quantité pour pouvoir remettre du stock à l'article
            $articleTaille->setQuantite($articleTaille->getQuantite() + $ajouter->getQuantite());
            $panier->removeAjouter($ajouter);
            $entityManagerInterface->persist($articleTaille);
            $entityManagerInterface->persist($panier);
        }

        // Ajout d'une quantité à l'article via le panier
        if ($action == 'addqte') {
            $ajouter->setQuantite($ajouter->getQuantite()+1);
            $tailleA = $ajouter->getTaille();
            $article2 = $ajouter->getProduit();
            $articleTaille = $entityManagerInterface->getRepository(ArticleTaille::class)->findOneBy([
                'article' => $article2,
                'taille' => $tailleA,
            ]);
            $articleTaille->setQuantite($articleTaille->getQuantite()-1);
            $entityManagerInterface->persist($ajouter);
            $entityManagerInterface->persist($articleTaille);
        }
        
        // Suppression d'une quantité à l'article via le panier
        if ($action == 'suppqte') {
            if ($ajouter->getQuantite()>=1) {
                $ajouter->setQuantite($ajouter->getQuantite()-1);
                $tailleA = $ajouter->getTaille();
                $article2 = $ajouter->getProduit();
                $articleTaille = $entityManagerInterface->getRepository(ArticleTaille::class)->findOneBy([
                    'article' => $article2,
                    'taille' => $tailleA,
                ]);
                $articleTaille->setQuantite($articleTaille->getQuantite()+1);
                $entityManagerInterface->persist($ajouter);
                $entityManagerInterface->persist($articleTaille);
            }
            if ($ajouter->getQuantite()==0) {
                $panier->removeAjouter($ajouter);
                $tailleA = $ajouter->getTaille();
                $article2 = $ajouter->getProduit();
                $articleTaille = $entityManagerInterface->getRepository(ArticleTaille::class)->findOneBy([
                    'article' => $article2,
                    'taille' => $tailleA,
                ]);
                $articleTaille->setQuantite($articleTaille->getQuantite() + 1);
                $entityManagerInterface->persist($articleTaille);
                $entityManagerInterface->persist($panier);
            }
        }
        
        // Supprime tous les articles présents dans le panier, et gère les stocks de taille dès qu'un article
        // est supprimé du panier
        if ($action == 'removePanier') {
            foreach($panier->getAjouters() as $ajout){
                $tailleA = $ajout->getTaille();
                $article2 = $ajout->getProduit();
                $articleTaille = $entityManagerInterface->getRepository(ArticleTaille::class)->findOneBy([
                    'article' => $article2,
                    'taille' => $tailleA,
                ]);
                $articleTaille->setQuantite($articleTaille->getQuantite() + $ajout->getQuantite());
                $panier->removeAjouter($ajout);
                $entityManagerInterface->persist($articleTaille);
                $entityManagerInterface->persist($panier);
            }
        }
        $entityManagerInterface->flush();
        
        return $this->redirectToRoute($page, array('id'=>$id) );
        return $this->render('panier/index.html.twig', []);
    }
}
