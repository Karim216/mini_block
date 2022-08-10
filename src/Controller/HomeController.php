<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    // private $objectManager;

    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        // $repo = $this->objectManager->getRepository(Article::class);
        $repo = $this->doctrine->getRepository(Article::class);

        $articles = $repo->findAll();

        // dd($articles);
        return $this->render('home/index.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/show/{id}', name: 'show')]
    public function show($id): Response
    {
        // $repo = $this->objectManager->getRepository(Article::class);
        $repo = $this->doctrine->getRepository(Article::class);

        $article = $repo->find($id);

        if(!$article){
            return $this->redirectToRoute('app_home');
        }

        return $this->render('show/index.html.twig', [
            'article' => $article
        ]);
    }
}
