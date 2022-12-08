<?php

namespace App\Controller;

use App\Entity\Commandearticle;
use App\Entity\Commandeservice;
use App\Entity\CommandeserviceServiceUtilisateur;
use App\Form\CmdArtType;
use App\Form\CmdSerType;
use App\Form\CommandeserviceServiceUtilisateurType;
use App\Repository\CommandearticleRepository;
use App\Repository\CommandeserviceRepository;
use App\Repository\CommandeserviceServiceUtilisateurRepository;
use App\Repository\FactureserviceRepository;
use App\Repository\ServiceRepository;
use App\Repository\UtilisateurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/{_locale}/commandeservice/service/utilisateur')]
class CommandeserviceServiceUtilisateurController extends AbstractController
{

    //Admin :  Afficher la liste des commande par admin
    #[Route('/listecmdservice', name: 'app_commandeservice_service_utilisateur_index', methods: ['GET'])]
    public function index(FactureserviceRepository $factureserviceRepository,PaginatorInterface $paginator ,CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository, UtilisateurRepository $userRepo, ServiceRepository $serviceRepo,CommandeserviceRepository $cmdRepo, Request $req): Response
    {
        $donnes = $commandeserviceServiceUtilisateurRepository->findAll();
        $commandeserviceServiceUtilisateurs = $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandeserviceServiceUtilisateurRepository->nontraitee();
        $encours=$commandeserviceServiceUtilisateurRepository->encour();
        $deja = $commandeserviceServiceUtilisateurRepository->deja();
        $auhourdhui=$commandeserviceServiceUtilisateurRepository->aujourdhui();
        return $this->render('commandeservice_service_utilisateur/index.html.twig', [
            'commandeservice_service_utilisateurs' => $commandeserviceServiceUtilisateurs,
            'user'=>$userRepo,
            'service'=>$serviceRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureserviceRepository,
        ]);
    }

    //Trier la liste des commandes avec l'utilisateur asc
    #[Route('/triutillistecmdservice', name: 'triutilser')]
    public function triUtilisateur(FactureserviceRepository $factureserviceRepository, PaginatorInterface $paginator ,CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository, UtilisateurRepository $userRepo, ServiceRepository $serviceRepo,CommandeserviceRepository $cmdRepo, Request $req)
    {
        $donnes = $commandeserviceServiceUtilisateurRepository->findallcmdutil();
        $commandeserviceServiceUtilisateurs = $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandeserviceServiceUtilisateurRepository->nontraitee();
        $encours=$commandeserviceServiceUtilisateurRepository->encour();
        $deja = $commandeserviceServiceUtilisateurRepository->deja();
        $auhourdhui=$commandeserviceServiceUtilisateurRepository->aujourdhui();
        return $this->render('commandeservice_service_utilisateur/index.html.twig', [
            'commandeservice_service_utilisateurs' => $commandeserviceServiceUtilisateurs,
            'user'=>$userRepo,
            'service'=>$serviceRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureserviceRepository
        ]);
    }

    //Trier la liste des commandes avec l'utilisateur desc
    #[Route('/triutillistedesccmdservice', name: 'triutilserdesc')]
    public function triUtilisateurdesc(FactureserviceRepository $factureserviceRepository, PaginatorInterface $paginator ,CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository, UtilisateurRepository $userRepo, ServiceRepository $serviceRepo,CommandeserviceRepository $cmdRepo, Request $req)
    {
        $donnes = $commandeserviceServiceUtilisateurRepository->findallcmddescutil();
        $commandeserviceServiceUtilisateurs = $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandeserviceServiceUtilisateurRepository->nontraitee();
        $encours=$commandeserviceServiceUtilisateurRepository->encour();
        $deja = $commandeserviceServiceUtilisateurRepository->deja();
        $auhourdhui=$commandeserviceServiceUtilisateurRepository->aujourdhui();
        return $this->render('commandeservice_service_utilisateur/index.html.twig', [
            'commandeservice_service_utilisateurs' => $commandeserviceServiceUtilisateurs,
            'user'=>$userRepo,
            'service'=>$serviceRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureserviceRepository
        ]);
    }

    //Trier la liste des commandes avec l'utilisateur
    #[Route('/tridatellistecmdservice', name: 'tridateser')]
    public function tridate(FactureserviceRepository $factureserviceRepository,PaginatorInterface $paginator ,CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository, UtilisateurRepository $userRepo, ServiceRepository $serviceRepo,CommandeserviceRepository $cmdRepo, Request $req)
    {
        $donnes = $commandeserviceServiceUtilisateurRepository->findallcmddate();
        $commandeserviceServiceUtilisateurs = $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandeserviceServiceUtilisateurRepository->nontraitee();
        $encours=$commandeserviceServiceUtilisateurRepository->encour();
        $deja = $commandeserviceServiceUtilisateurRepository->deja();
        $auhourdhui=$commandeserviceServiceUtilisateurRepository->aujourdhui();
        return $this->render('commandeservice_service_utilisateur/index.html.twig', [
            'commandeservice_service_utilisateurs' => $commandeserviceServiceUtilisateurs,
            'user'=>$userRepo,
            'service'=>$serviceRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureserviceRepository
        ]);
    }

    //Trier la liste des commandes avec l'utilisateur
    #[Route('/tridatellistecmddescservice', name: 'tridatedescser')]
    public function tridatedesc(FactureserviceRepository $factureserviceRepository,PaginatorInterface $paginator ,CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository, UtilisateurRepository $userRepo, ServiceRepository $serviceRepo,CommandeserviceRepository $cmdRepo, Request $req)
    {
        $donnes = $commandeserviceServiceUtilisateurRepository->findallcmddescdate();
        $commandeserviceServiceUtilisateurs = $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        $nontraitee = $commandeserviceServiceUtilisateurRepository->nontraitee();
        $encours=$commandeserviceServiceUtilisateurRepository->encour();
        $deja = $commandeserviceServiceUtilisateurRepository->deja();
        $auhourdhui=$commandeserviceServiceUtilisateurRepository->aujourdhui();
        return $this->render('commandeservice_service_utilisateur/index.html.twig', [
            'commandeservice_service_utilisateurs' => $commandeserviceServiceUtilisateurs,
            'user'=>$userRepo,
            'service'=>$serviceRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
            'facture'=>$factureserviceRepository
        ]);
    }

    //Utilisateur : Modifier une commande de service par un utilisateur
    #[Route('/{idcommandeservice}/{a}/editcmd', name: 'app_commandeservice_service_utilisateur_editsercmd')]
    public function editsercmd($a,Request $request, Commandeservice $commandeservice, CommandeserviceRepository $commandeserviceRepository)
    {
        $form = $this->createForm(CmdSerType::class, $commandeservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeserviceRepository->save($commandeservice, true);

            return $this->redirectToRoute('app_commandeservice_service_utilisateur_cmdserutil', ['id'=>$a], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandeservice_service_utilisateur/editcmdserutilisateur.html.twig', [
            'commandeservice' => $commandeservice,
            'form' => $form,
            'a'=>$a,
        ]);
    }

    //Utilisateur : Affichage liste des commandes pour un seul utilisateur
    #[Route('/{id}', name: 'app_commandeservice_service_utilisateur_cmdserutil', methods: ['GET'])]
    public function cmdserutil(FactureserviceRepository $facture,PaginatorInterface $paginator,Request $req,$id,CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository, UtilisateurRepository $userRepo, ServiceRepository $serviceRepo,CommandeserviceRepository $cmdRepo): Response
    {
        $donnes= $commandeserviceServiceUtilisateurRepository->findCmdUser($id);
        $commandeserviceServiceUtilisateur= $paginator->paginate(
            $donnes,
            $req->query->getInt('page', 1),
            5
        );
        return $this->render('commandeservice_service_utilisateur/show.html.twig', [
            'commandeservice_service_utilisateurs' => $commandeserviceServiceUtilisateur,
            'user'=>$userRepo,
            'service'=>$serviceRepo,
            'commande'=>$cmdRepo,
            'facture'=>$facture,
        ]);
    }



    //Rechercher Admin commande service
    #[Route('/recherche', name: 'app_commandeservice_service_utilisateur_rechercher')]
    public function rechercher(PaginatorInterface $paginator,CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository, UtilisateurRepository $userRepo, ServiceRepository $serviceRepo,CommandeserviceRepository $cmdRepo, Request $request)
    {
        $data=$request->get('search');
        $utilis=$userRepo->findUserAdmin($data);
        $donnes= $commandeserviceServiceUtilisateurRepository->findCmdUser($utilis->getIduser());
        $commandeserviceServiceUtilisateur= $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        $nontraitee = $commandeserviceServiceUtilisateurRepository->nontraitee();
        $encours=$commandeserviceServiceUtilisateurRepository->encour();
        $deja = $commandeserviceServiceUtilisateurRepository->deja();
        $auhourdhui=$commandeserviceServiceUtilisateurRepository->aujourdhui();
        return $this->render('commandeservice_service_utilisateur/index.html.twig', [
            'commandeservice_service_utilisateurs' => $commandeserviceServiceUtilisateur,
            'user'=>$userRepo,
            'service'=>$serviceRepo,
            'commande'=>$cmdRepo,
            'nontraitee'=>$nontraitee[0][1],
            'encours'=>$encours[0][1],
            'deja'=>$deja[0][1],
            'aujourdhui'=>$auhourdhui[0][1],
        ]);
    }

}
