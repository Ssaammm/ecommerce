<?php

namespace App\Controller;

use App\Entity\Article;
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
}
