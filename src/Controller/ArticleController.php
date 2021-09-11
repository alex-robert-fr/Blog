<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}')]
    public function index(int $id, ArticleRepository $articleRepository, CommentaireRepository $commentaireRepository, Request $request): Response
    {
        /**
         * *---Recovery articles---*
         */
        $article = $articleRepository->find($id);
        $id = strval($id);

        /**
         * *---Recovery comments---*
         */
        $commentsArticle = $commentaireRepository->findBy(['article' => $id]);

        /**
         * *---Form---*
         */
        $comments = new Commentaire();
        $form = $this->createForm(CommentaireType::class,$comments);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($comments);
            $entityManager->flush();
        }

        return $this->render('article/index.html.twig', [
            'id' => $id,
            'form' => $form->createView(),
            'article' => $article,
            'comments' => $commentsArticle
        ]);
    }
}
