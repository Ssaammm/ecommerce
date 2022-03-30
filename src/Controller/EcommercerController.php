<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EcommercerController extends AbstractController
{
    /**
     * @Route("/ecommerce", name="app_ecommerce")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();

        return $this->render('ecommercer/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/ecommerce/cat1", name="cat1")
     */
    public function cat1(): Response
    {
        $repoC = $this->getDoctrine()->getRepository(Category::class);
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findBy(array('category' => 4));
        $nomCat = $repoC->find(4);

        return $this->render('ecommercer/cat1.html.twig', [
            'articles' => $articles,
            'nom'=> $nomCat
        ]);
    }

        /**
     * @Route("/ecommerce/cat2", name="cat2")
     */
    public function cat2(): Response
    {
        $repoC = $this->getDoctrine()->getRepository(Category::class);
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findBy(array('category' => 5));
        $nomCat = $repoC->find(5);

        return $this->render('ecommercer/cat2.html.twig', [
            'articles' => $articles,
            'nom'=> $nomCat
            
        ]);
    }

    /**
     * @Route("/ecommerce/cat3", name="cat3")
     */
    public function cat3(): Response
    {
        $repoC = $this->getDoctrine()->getRepository(Category::class);
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findBy(array('category' => 6));
        $nomCat = $repoC->find(6);

        return $this->render('ecommercer/cat2.html.twig', [
            'articles' => $articles,
            'nom'=> $nomCat
        ]);
    }

    /**
     * @Route("/ecommerce/cat/{id}", name="show")
     */
    public function affiche($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);

        return $this->render('ecommercer/affiche.html.twig', [
            'article' => $article
       
        ]);
    }

 }
