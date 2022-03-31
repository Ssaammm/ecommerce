<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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


    /**
     * @Route("/ecommerce/new", name="form_new")
     * @Route("/ecommerce/{id}/edit", name="form_edit")
     */
    public function form(Article $article=null, Request $request, ObjectManager $manager) : Response
    {   
        if(!$article){
            $article = new Article();
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            if(!$article->getId()){
                $article->setDate(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('show', ['id' => $article->getId()]);
            
        }

        return $this->render('ecommercer/form.html.twig', [
            'form' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);   

    }
    
     /**
     * @Route("/ecommerce/{id}/delete", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article, ArticleRepository $stagiaireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $stagiaireRepository->remove($article);
        }

        return $this->redirectToRoute('ecommerce/cat1/html.twig', [], Response::HTTP_SEE_OTHER);
    }

}