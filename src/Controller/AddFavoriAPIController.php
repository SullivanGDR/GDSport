<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class AddFavoriAPIController extends AbstractController
{
    public function __invoke(int $id, int $articleId, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $article = $entityManager->getRepository(Article::class)->find($articleId);
        $user->addFavori($article);
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Favori added successfully'], JsonResponse::HTTP_CREATED);
    }
}
