<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Utilisateur;
use App\Form\ArtformType;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\AvisRepository;
use App\Repository\CategoriearticleRepository;
use App\Repository\MagasinRepository;
use App\Repository\UtilisateurRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/article')]
class ArticleController extends AbstractController
{
    ############################## FRONT ###########################################

    #[Route('/front/', name: 'app_article_index_front', methods: ['GET'])]
    public function index(PaginatorInterface $paginator,ArticleRepository $articleRepository,MagasinRepository $magasinRepository,CategoriearticleRepository $categoriearticleRepository,Request $request): Response
    {
        $magasins=$magasinRepository->findAll();
        $categories=$categoriearticleRepository->findAll();
        // Paginate the results of the query
        $data=$articleRepository->findAll();
        $articles =$paginator->paginate(
        // Doctrine Query, not results
            $data,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            12);
        return $this->render('article/indexfront.html.twig', [
            'articles' => $articles,
            'magasins' => $magasins,
            'categories' => $categories,

        ]);
    }

    #[Route('/front/new', name: 'app_article_new_front', methods: ['GET', 'POST'])]
    public function new(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article, true);

            return $this->redirectToRoute('app_article_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/newfront.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idarticle}', name: 'app_article_show_front', methods: ['GET'])]
    public function show(Article $article,AvisRepository $avisRepository): Response
    {
        $liste = $avisRepository->findgg($article->getIdarticle());
        $note = 0;
        $i = 0;
        foreach ($liste as $list){
            $i++;
            $note = $note + $list->getNoteservice();
        }
        if($i!=0){
            $note = $note / $i ;
        }
        else{
            $note = 0;
        }
        return $this->render('article/showfront.html.twig', [
            'article' => $article,
            'note'=>$note
        ]);
    }

    #[Route('/front/{idarticle}/edit', name: 'app_article_edit_front', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article, true);

            return $this->redirectToRoute('app_article_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/editfront.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idarticle}', name: 'app_article_delete_front', methods: ['POST'])]
    public function delete(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getIdarticle(), $request->request->get('_token'))) {
            $articleRepository->remove($article, true);
        }

        return $this->redirectToRoute('app_article_index_front', [], Response::HTTP_SEE_OTHER);
    }

    ############################## BACK ###########################################

    #[Route('/back/', name: 'app_article_index_back', methods: ['GET'])]
    public function indexback(PaginatorInterface $paginator,ArticleRepository $articleRepository,Request $request): Response
    {
        // Paginate the results of the query
        $data=$articleRepository->findAll();
        $articles =$paginator->paginate(
        // Doctrine Query, not results
            $data,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
           10);
        return $this->render('article/indexback.html.twig', [
            'articles' => $articles,

        ]);
    }

    #[Route('/back/new', name: 'app_article_new_back', methods: ['GET', 'POST'])]
    public function newback(Request $request,ArticleRepository $articleRepository,UtilisateurRepository $utilisateurRepository,MailerInterface $mailer): Response
    {
        $nbr= count($utilisateurRepository->findAll());
        $user= $utilisateurRepository->findAll();
        $u = new Utilisateur();
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article, true);

            for($i=0;$i<$nbr;$i++){

            $maile=[];
            $msg= $article->getNomarticle();
            $email = (new Email())
                ->from('539da53abe94bb@smtp.mailtrap.io')
                ->to('kais.chalghoumi@esprit.tn')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Nouveau article!')
                ->text('Bonne nouvelle!!!! un nouveau produit vient d"etre ajouter!')
                ->html(`<p>$msg</p>`);

            $mailer->send($email);
            }

            return $this->redirectToRoute('app_article_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/newback.html.twig', [
            'article' => $article,
            'form' => $form,array("form"=>$form->createView())
        ]);
    }

    #[Route('/back/{idarticle}', name: 'app_article_show_back', methods: ['GET'])]
    public function showback(Article $article): Response
    {
        return $this->render('article/showback.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/back/{idarticle}/edit', name: 'app_article_edit_back', methods: ['GET', 'POST'])]
    public function editback(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $form = $this->createForm(ArtformType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article, true);

            return $this->redirectToRoute('app_article_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/editback.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idarticle}', name: 'app_article_delete_back', methods: ['POST'])]
    public function deleteback(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getIdarticle(), $request->request->get('_token'))) {
            $articleRepository->remove($article, true);
        }

        return $this->redirectToRoute('app_article_index_back', [], Response::HTTP_SEE_OTHER);
    }
}
