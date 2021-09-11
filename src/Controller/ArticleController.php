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
        $id = strval($id);

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
        ]);
    }
}
