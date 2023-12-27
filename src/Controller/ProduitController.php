<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AjoutProduitType;
use App\Form\AjoutTailleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Article;
use App\Entity\ImagesArticle;
use App\Entity\Taille;
use App\Entity\ArticleTaille;
use Symfony\Component\Filesystem\Filesystem;

class ProduitController extends AbstractController
{
    // Page ajout d'un produit
    #[Route('/admin-ajout-produit', name: 'ajout-produit')]
    public function index(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {
        // Nouvel article
        $produit = new Article();

        // Récupération du formulaire de l'article
        $form = $this->createForm(AjoutProduitType::class, $produit);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                // Récupération des images
                $fichiers = $form->get('images')->getData();

                // Récupération de la marque
                $marque = $form->get('marque')->getData();

                // On récupére tous les fichier d'image
                foreach($fichiers as $fichier){
                    if($fichier){
                    $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                    $nomFichier = $slugger->slug($nomFichier);
                    $nomFichier = $nomFichier.'-'.uniqid().'.'.$fichier->guessExtension();
                        try{                 
                            $fichier->move($this->getParameter('file_directory'), $nomFichier);
                            $image = new ImagesArticle();
                            $image->setName($nomFichier);
                            $image->setArticle($produit);
                            $entityManagerInterface->persist($image);
                            $this->addFlash('notice', 'Article ajouté');
                        }
                        catch(FileException $e){
                            $this->addFlash('notice', 'Erreur d\'envoi de l\'article');
                        }        
                    }  
                }
                $produit->setNbFavoris(0);
                $produit->setNote(5);
                $produit->setMarque($marque);
                $entityManagerInterface->persist($produit);
                $entityManagerInterface->flush();
                return $this->redirectToRoute('ajout-taille', ['id' => $produit->getId()]);
            }
        }
        return $this->render('produit/ajout-produit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Page d'ajout d'une taille
    #[Route('/admin-ajout-taille/{id}', name: 'ajout-taille')]
    public function ajoutTaille(Request $request, EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {
        // Récupération de l'id de l'article
        $id = $request->get('id');

        // Récupération de l'article
        $article = $entityManagerInterface->getRepository(Article::class)->find($id);

        // Récupération des tailles de l'article
        $tailles = $entityManagerInterface->getRepository(ArticleTaille::class)->findBy([
            'article' => $article
        ]);

        // Nouvelle taille
        $new_taille = new ArticleTaille();

        // Récupération du formulaire de la taille
        $form = $this->createForm(AjoutTailleType::class, $new_taille);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $tailleExiste = false;
                foreach ($tailles as $taille) {
                    if ($taille->getTaille() === $new_taille->getTaille()) {
                        $tailleExiste = true;
                        break;
                    }
                }
                if (!$tailleExiste) {
                    $new_taille->setArticle($article);
                    $entityManagerInterface->persist($new_taille);
                    $entityManagerInterface->flush();
                    $this->addFlash('success', 'La taille a bien été ajoutée.');
                    return $this->redirectToRoute('ajout-taille', ['id' => $id]);
                } else {
                    $this->addFlash('error', 'La taille existe déjà.');
                }
            }
        }
        return $this->render('produit/ajout-taille.html.twig', [
            'form' => $form->createView(),
            'tailles' => $tailles
        ]);
    }

    // Page de suppression d'une taille
    #[Route('/admin-supprimer-taille/{id}', name: 'supprimer-taille')]
    public function supprimerTaille(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération de l'id taille de l'article 
        $id = $request->get('id');

        // Récupération de la taille
        $taille = $entityManagerInterface->getRepository(ArticleTaille::class)->find($id);

        // Récupération de l'article pour retourner sur sa page
        $articleId = $taille->getArticle()->getId();

        $entityManagerInterface->remove($taille);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('ajout-taille', ['id' => $articleId]);
    }

    // Page de modification d'un article
    #[Route('/admin-edit-article/{id}', name: 'edit-article')]
    public function editArticle(Request $request , EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération de l'id de l'article
        $id = $request->get('id');

        // Récupération de l'article
        $article = $entityManagerInterface->getRepository(Article::class)->find($id);

        // Récupération des données du formulaire
        $form = $this->createForm(AjoutProduitType::class, $article);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){   
                $entityManagerInterface->persist($article);
                $entityManagerInterface->flush();
                
                $this->addFlash('notice','Article modifié');
                return $this->redirectToRoute('ajout-taille', ['id' => $id]);
            }
        }
        return $this->render('produit/edit-article.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Page de la liste des articles
    #[Route('/admin-liste-article', name: 'liste-article')]
    public function listeArticle(Request $request , EntityManagerInterface $entityManagerInterface): Response
    {
        $articles = $entityManagerInterface->getRepository(Article::class)->findAll();

        return $this->render('produit/liste-article.html.twig', [
            'articles' => $articles
        ]);
    }

    // Page de suppression d'un article
    #[Route('/admin-supprimer-article', name: 'supprimer-article')]
    public function supprimerArticle(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // Récupération de l'id de l'article
        $id = $request->get('id');

        // Récupération de l'article
        $article = $entityManagerInterface->getRepository(Article::class)->find($id);

        // Récupération des images de l'article
        $images=$article->getImage();

        // Permet de supprimer les images sur le serveur
        $filesystem = new Filesystem();
        foreach ($images as $image) {
            $path = $this->getParameter('file_directory').'/'.$image->getName();
            if ($filesystem->exists($path)) {
                $filesystem->remove($path);
            }
        }

        // Supprimer l'article
        $entityManagerInterface->remove($article);
        $entityManagerInterface->flush();
        $this->addFlash('notice', 'article supprimé');
        return $this->redirectToRoute('liste-article');
        return $this->render('produit/liste-article.html.twig', [

        ]);
    }

    // Page découverte nike
    #[Route('/decouvrir-nike', name: 'decouvrir-nike')]
    public function decouvrirNike(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $articles = $entityManagerInterface->getRepository(Article::class)->findAll();
        
        return $this->render('base/nike.html.twig', [
            'articles' => $articles

        ]);
    }
} 
 