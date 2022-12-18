<?php

namespace App\Controller;

use App\Entity\Commandeservice;
use App\Entity\CommandeserviceServiceUtilisateur;
use App\Entity\Service;
use App\Form\CmdSerType;
use App\Form\CommandeserviceType;
use App\Repository\CommandeserviceRepository;
use App\Repository\CommandeserviceServiceUtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;

#[Route('/{_locale}/commandeservice')]
class CommandeserviceController extends AbstractController
{
    #[Route('/', name: 'app_commandeservice_index', methods: ['GET'])]
    public function index(CommandeserviceRepository $commandeserviceRepository): Response
    {
        return $this->render('commandeservice/index.html.twig', [
            'commandeservices' => $commandeserviceRepository->findAll(),
        ]);
    }

    #[Route('/new/{idservice}', name: 'app_commandeservice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Service $service , CommandeserviceRepository $commandeserviceRepository, CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository): Response
    {
        $commandeservice = new Commandeservice();
        $form = $this->createForm(CmdSerType::class, $commandeservice);
        $form->handleRequest($request);
        $commandeserviceServiceUtilisateur = new CommandeserviceServiceUtilisateur();
        if ($form->isSubmitted() && $form->isValid()) {
            $time = date('Y/m/d');
            $commandeservice ->setDatecommandeservice($time);
            $commandeserviceRepository->save($commandeservice, true);
            $commandeserviceServiceUtilisateur->setIdcommandeservice($commandeservice->getIdcommandeservice());
            $commandeserviceServiceUtilisateur->setIdutilisateur(17);
            $commandeserviceServiceUtilisateur->setIdservice($service->getIdservice());
            $commandeserviceServiceUtilisateurRepository->save($commandeserviceServiceUtilisateur,true);
            // SMS
/*
            $sid = "ACda633fc1b6c821502df86b8c5e29ce95";
                        $token = "167f56216211940bc42cb47f08863591";
                        $twilio = new Client($sid, $token);
                        $message = $twilio->messages
                            ->create("+21620542959", // to
                                array(
                                    "from" => "+15627844569",
                        "body" => "Equipe RAMCHA vous remercie pour votre confiance ! Votre commande (N°: ". $commandearticle->getIdcommande() . ") sera livrée en quelque jours. RESTEZ A L'ECOUTE !"
                                )
                            );
*/
            return $this->redirectToRoute('viewpdfservice', [
                'utilisateur'=>$commandeserviceServiceUtilisateur->getIdutilisateur(),
                'bb'=>$commandeserviceServiceUtilisateur->getIdservice(),
                'commande'=>$commandeservice->getIdcommandeservice(),
            ], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('commandeservice/new.html.twig', [
            'commandeservice' => $commandeservice,
            'form' => $form,
            'service'=> $service,
        ]);
    }

    #[Route('/{idcommandeservice}', name: 'app_commandeservice_show', methods: ['GET'])]
    public function show(Commandeservice $commandeservice): Response
    {
        return $this->render('commandeservice/show.html.twig', [
            'commandeservice' => $commandeservice,
        ]);
    }

    //Admin : modifier commande service
    #[Route('/{idcommandeservice}/edit', name: 'app_commandeservice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commandeservice $commandeservice, CommandeserviceRepository $commandeserviceRepository): Response
    {
        $form = $this->createForm(CommandeserviceType::class, $commandeservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeserviceRepository->save($commandeservice, true);

            return $this->redirectToRoute('app_commandeservice_service_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandeservice/edit.html.twig', [
            'commandeservice' => $commandeservice,
            'form' => $form,
        ]);
    }

    //Admin : Supprimer commande service
    #[Route('/{idcommandeservice}', name: 'app_commandeservice_delete', methods: ['POST'])]
    public function delete(Request $request, Commandeservice $commandeservice, CommandeserviceRepository $commandeserviceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeservice->getIdcommandeservice(), $request->request->get('_token'))) {
            $commandeservice->setStatuscommande("Rejetée");
            $commandeserviceRepository->save($commandeservice, true);
        }

        return $this->redirectToRoute('app_commandeservice_service_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }

    //Client : Supprimer commande service
    #[Route('/{idcommandeservice}/{a}', name: 'app_commandeservice_eletecmdser')]
    public function deleteutilcmdser($a,Request $request, Commandeservice $commandeservice, CommandeserviceRepository $commandeserviceRepository)
    {
        if ($this->isCsrfTokenValid('delete'.$commandeservice->getIdcommandeservice(), $request->request->get('_token'))) {
            $commandeserviceRepository->remove($commandeservice, true);
        }

        return $this->redirectToRoute('app_commandeservice_service_utilisateur_cmdserutil', ['id'=>$a], Response::HTTP_SEE_OTHER);
    }


}
