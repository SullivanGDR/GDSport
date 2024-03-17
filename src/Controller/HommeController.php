<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Type;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ImagesArticle;
use Symfony\Component\HttpFoundation\Request;

class HommeController extends AbstractController
{
    #[Route('/homme', name: 'homme')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/index.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements', name: 'homme-vetements')]
    public function hommeVetements(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/accessoires', name: 'homme-accessoires')]
    public function hommeAccessoires(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/accessoires.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/chaussures', name: 'homme-chaussures')]
    public function hommeChaussures(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/chaussures.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/sweats', name: 'homme-sweats')]
    public function hommeSweats(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/sweats.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/sweat-shirts', name: 'homme-sweat-shirts')]
    public function hommeSweatShirts(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/sweatshirts.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/vestes', name: 'homme-vestes')]
    public function hommeVestes(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/vestes.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/chemises', name: 'homme-chemises')]
    public function hommeChemises(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/chemises.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/t-shirts', name: 'homme-t-shirts')]
    public function hommeTshirts(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/tshirts.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/jeans', name: 'homme-jeans')]
    public function hommeJeans(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/jeans.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/pantalon', name: 'homme-pantalons')]
    public function hommePantalons(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/pantalons.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/shorts', name: 'homme-shorts')]
    public function hommeShorts(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/shorts.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/joggings', name: 'homme-joggings')]
    public function hommeJoggings(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/joggings.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/sous-vêtements', name: 'homme-sous-vêtements')]
    public function hommeSousVetements(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/sousvetements.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/chaussettes', name: 'homme-chaussettes')]
    public function hommeChaussettes(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/vetements/chaussettes.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
    #[Route('/homme/vêtements/nike', name: 'homme-nike')]
    public function hommeNike(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $hommeGenre =$entityManagerInterface->getRepository(Genre::class)->findBy(['libelle' => 'Homme']);
        $articlesHomme =$entityManagerInterface->getRepository(Article::class)->findBy(['genre' => $hommeGenre]);
        return $this->render('homme/nike.html.twig', [
            'articles' => $articlesHomme
        ]);
    }
}
