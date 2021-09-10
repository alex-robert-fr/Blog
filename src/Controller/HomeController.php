<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('home/index.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/insert')]
    public function insertArticles(): Response
    {
        $article = new Article();
        $article->setTitle('Dernier article !!!');
        $article->setContent('Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim
        labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi
        animcupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est
        aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia
        pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit
        commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa
        proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia
        eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim.
        Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et
        culpa duis.Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim
        labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi
        animcupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est
        aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia
        pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit
        commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa
        proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia
        eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim.
        Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et
        culpa duis.Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim
        labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi
        animcupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est
        aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia
        pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit
        commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa
        proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia
        eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim.
        Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et
        culpa duis.');
        $article->setDate(new \DateTime('now'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();

        return new Response('<body>Envoie d\'un arcticle à la base de donnée</body>');
    }
}
