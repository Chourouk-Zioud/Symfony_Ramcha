<?php

namespace App\Controller;

use App\Entity\Commandearticle;
use App\Entity\CommandearticleArticleUtilisateur;
use App\Entity\Utilisateur;
use App\Form\CmdArtType;
use App\Form\CommandearticleArticleUtilisateurType;
use App\Form\CommandearticleType;
use App\Repository\ArticleRepository;
use App\Repository\CommandearticleArticleUtilisateurRepository;
use App\Repository\CommandearticleRepository;
use App\Repository\FactureRepository;
use App\Repository\UtilisateurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/{_locale}/commandearticle/article/utilisateur')]
class CommandearticleArticleUtilisateurController extends AbstractController
{

    //Trier la liste des commandes avec l'utilisateur
    #[Route('/triutillistecmdarticle', name: 'tri')]
    public function tri(FactureRepository $factureRepository,PaginatorInterface $paginator,CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, UtilisateurRepository $userRepo, ArticleRepository $articleRepo, CommandearticleRepository $cmdRepo, Request $req)
    {
        $donnes= $commandearticleArticleUtilisateurRepository->findallcmdutil();
        $commandearticleArticleUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandearticleArticleUtilisateurRepository->nontraitee();
        $encours=$commandearticleArticleUtilisateurRepository->encour();
        $deja = $commandearticleArticleUtilisateurRepository->deja();
        $auhourdhui=$commandearticleArticleUtilisateurRepository->aujourdhui();

        return $this->render('commandearticle_article_utilisateur/index.html.twig', [
            'commandearticle_article_utilisateurs' => $commandearticleArticleUtilisateur,
            'user' => $userRepo,
            'article'=>$articleRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureRepository

        ]);
    }

    //Trier la liste des commandes avec l'utilisateur
    #[Route('/triutillistecmddescarticle', name: 'tridesc')]
    public function tridesc(FactureRepository $factureRepository,PaginatorInterface $paginator,CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, UtilisateurRepository $userRepo, ArticleRepository $articleRepo, CommandearticleRepository $cmdRepo, Request $req)
    {
        $donnes= $commandearticleArticleUtilisateurRepository->findallcmddescutil();
        $commandearticleArticleUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandearticleArticleUtilisateurRepository->nontraitee();
        $encours=$commandearticleArticleUtilisateurRepository->encour();
        $deja = $commandearticleArticleUtilisateurRepository->deja();
        $auhourdhui=$commandearticleArticleUtilisateurRepository->aujourdhui();

        return $this->render('commandearticle_article_utilisateur/index.html.twig', [
            'commandearticle_article_utilisateurs' => $commandearticleArticleUtilisateur,
            'user' => $userRepo,
            'article'=>$articleRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureRepository

        ]);
    }

    //Trier la liste des commandes avec l'utilisateur
    #[Route('/tridatellistecmdarticle', name: 'tridateart')]
    public function tridate(FactureRepository $factureRepository,PaginatorInterface $paginator,CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, UtilisateurRepository $userRepo, ArticleRepository $articleRepo, CommandearticleRepository $cmdRepo, Request $req)
    {
        $donnes= $commandearticleArticleUtilisateurRepository->findallcmddate();
        $commandearticleArticleUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandearticleArticleUtilisateurRepository->nontraitee();
        $encours=$commandearticleArticleUtilisateurRepository->encour();
        $deja = $commandearticleArticleUtilisateurRepository->deja();
        $auhourdhui=$commandearticleArticleUtilisateurRepository->aujourdhui();

        return $this->render('commandearticle_article_utilisateur/index.html.twig', [
            'commandearticle_article_utilisateurs' => $commandearticleArticleUtilisateur,
            'user' => $userRepo,
            'article'=>$articleRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureRepository

        ]);
    }

    //Trier la liste des commandes avec l'utilisateur
    #[Route('/tridatellistecmddescarticle', name: 'tridatedescart')]
    public function tridatedesc(FactureRepository $factureRepository,PaginatorInterface $paginator,CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, UtilisateurRepository $userRepo, ArticleRepository $articleRepo, CommandearticleRepository $cmdRepo, Request $req)
    {
        $donnes= $commandearticleArticleUtilisateurRepository->findallcmddescdate();
        $commandearticleArticleUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandearticleArticleUtilisateurRepository->nontraitee();
        $encours=$commandearticleArticleUtilisateurRepository->encour();
        $deja = $commandearticleArticleUtilisateurRepository->deja();
        $auhourdhui=$commandearticleArticleUtilisateurRepository->aujourdhui();

        return $this->render('commandearticle_article_utilisateur/index.html.twig', [
            'commandearticle_article_utilisateurs' => $commandearticleArticleUtilisateur,
            'user' => $userRepo,
            'article'=>$articleRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureRepository

        ]);
    }

    //Modifier une commande d'article par un utilisateur
    #[Route('/{idcommande}/{a}/editcmd', name: 'app_commandearticle_article_utilisateur_editcmd')]
    public function editcmd($a,Request $request, Commandearticle $commandearticle, CommandearticleRepository $commandearticleRepository)
    {
        $form = $this->createForm(CmdArtType::class, $commandearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandearticleRepository->save($commandearticle, true);

            return $this->redirectToRoute('app_commandearticle_article_utilisateur_cmdutil', ['id'=>$a], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandearticle_article_utilisateur/editcmdutilisateur.html.twig', [
            'commandearticle' => $commandearticle,
            'form' => $form,
            'a'=>$a,
        ]);
    }

    //Affichage liste des commandes pour l'admin
    #[Route('/listecmdart', name: 'app_commandearticle_article_utilisateur_index', methods: ['GET'])]
    public function index(FactureRepository $factureRepository,PaginatorInterface $paginator,CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, UtilisateurRepository $userRepo, ArticleRepository $articleRepo, CommandearticleRepository $cmdRepo, Request $req): Response
    {
        $donnes= $commandearticleArticleUtilisateurRepository->findAll();
        $commandearticleArticleUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandearticleArticleUtilisateurRepository->nontraitee();
        $encours=$commandearticleArticleUtilisateurRepository->encour();
        $deja = $commandearticleArticleUtilisateurRepository->deja();
        $auhourdhui=$commandearticleArticleUtilisateurRepository->aujourdhui();

        return $this->render('commandearticle_article_utilisateur/index.html.twig', [
            'commandearticle_article_utilisateurs' => $commandearticleArticleUtilisateur,
            'user' => $userRepo,
            'article'=>$articleRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureRepository
        ]);
    }

    //Affichage liste des commandes pour un seul utilisateur
    #[Route('/{id}', name: 'app_commandearticle_article_utilisateur_cmdutil', methods: ['GET'])]
    public function cmdutil(FactureRepository $facrepo,PaginatorInterface $paginator,Request $req,$id,CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, UtilisateurRepository $userRepo, ArticleRepository $articleRepo, CommandearticleRepository $cmdRepo): Response
    {
        $donnes= $commandearticleArticleUtilisateurRepository->findCmdUser($id);
        $commandearticleArticleUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );

        return $this->render('commandearticle_article_utilisateur/show.html.twig', [
            'commandearticle_article_utilisateurs' => $commandearticleArticleUtilisateur,
            'user' => $userRepo,
            'article'=>$articleRepo,
            'commande'=>$cmdRepo,
            'facture'=>$facrepo,
        ]);
    }



    //Rechercher admin commande service
    #[Route('/rechercher', name: 'app_commandearticle_article_utilisateur_recherche')]
    public function rechercher(Request $req,PaginatorInterface $paginator,CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, UtilisateurRepository $userRepo, ArticleRepository $articleRepo, CommandearticleRepository $cmdRepo ,Request $request)
    {
        $data=$request->get('search');
        $utilis=$userRepo->findUserAdmin($data);
        $donnes= $commandearticleArticleUtilisateurRepository->findCmdUser($utilis->getIduser());
        $commandearticleArticleUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        return $this->render('commandearticle_article_utilisateur/index.html.twig', [
            'commandearticle_article_utilisateurs' => $commandearticleArticleUtilisateur,
            'user' => $userRepo,
            'article'=>$articleRepo,
            'commande'=>$cmdRepo,
        ]);
    }




    }
