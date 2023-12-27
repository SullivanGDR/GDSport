<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Avis;
use App\Entity\ImagesArticle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Form\AvisType;

class BaseController extends AbstractController
{
    // Page index
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération des différentes données (Tous les articles, les images associées)
        $tousArticles = $entityManagerInterface->getRepository(Article::class)->findAll();
        $images = $entityManagerInterface->getRepository(ImagesArticle::class)->findAll();
        return $this->render('base/index.html.twig', [
            'tousArticles' => $tousArticles,
            'images' => $images
        ]);
    }

    // Page d'un article 
    #[Route('/article/{id}', name: 'article')]
    public function article(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Génération des dates par rapport à la date du jour pour l'affichage dynamique de la livraison
        $date5 = new \Datetime();
        $date5->modify('+5 days');
        $date7 = new \Datetime();
        $date7->modify('+7 days');

        // Récupération de l'id de l'article
        $id = $request->get('id');

        // Récupération de l'article via le repository
        $article = $entityManagerInterface->getRepository(Article::class)->find($id);
        
        // Récupération des images de l'article
        $images = $entityManagerInterface->getRepository(ImagesArticle::class)->findOneBy(array('article'=>$id));

        // Récupération des avis
        $avisArticle = $article->getAvis();

        // Création d'un avis en récupérant le formulaire
        $avis = new Avis();

        $form = $this->createForm(AvisType::class, $avis);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){   
                $avis->setUser($this->getUser());
                $avis->setArticle($article);
                $avis->setDate(new \Datetime());
                $moyenne = ($article->getNote()+$avis->getNote())/2;
                $article->setNote($moyenne);
                $entityManagerInterface->persist($avis);
                $entityManagerInterface->flush();

                return $this->redirectToRoute('article', ['id' => $id]);
            }
        }

        return $this->render('base/article.html.twig', [
            'article' => $article,
            'images' => $images,
            'date5' => $date5,
            'date7' => $date7,
            'form' => $form->createView(),
            'avisArticle' => $avisArticle
        ]);
    }

} 