<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}')]
    public function index(int $id, ArticleRepository $articleRepository, Request $request): Response
    {
        $article = $articleRepository->find($id);

        /**
         * *---Form---*
         */
        $comments = new Commentaire();
        $form = $this->createForm(CommentaireType::class,$comments);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comments->setArticle($comments->getArticle());
            $comments->setComment($comments->getComment());
            $comments->setName($comments->getName());
            $comments->setCreatedAt($comments->getCreatedAt());

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($comments);
            $entityManager->flush();
        }

        return $this->render('article/index.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }
}
