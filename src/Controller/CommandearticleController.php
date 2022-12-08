<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commandearticle;
use App\Entity\CommandearticleArticleUtilisateur;
use App\Form\CmdArtType;
use App\Form\CommandearticleType;
use App\Repository\CommandearticleArticleUtilisateurRepository;
use App\Repository\CommandearticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;

#[Route('/{_locale}/commandearticle')]
class CommandearticleController extends AbstractController
{

    #[Route('/', name: 'app_commandearticle_index', methods: ['GET'])]
    public function index(CommandearticleRepository $commandearticleRepository): Response
    {
        return $this->render('commandearticle/index.html.twig', [
            'commandearticles' => $commandearticleRepository->findAll(),
        ]);
    }

    #[Route('/new/{idarticle}', name: 'app_commandearticle_new', methods: ['GET', 'POST'])]
    public function new(Request $request,Article $article, CommandearticleRepository $commandearticleRepository, CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository): Response
    {
        $commandearticle = new Commandearticle();
        $form = $this->createForm(CmdArtType::class, $commandearticle);
        $form->handleRequest($request);
        $commandearticleArticleUtilisateur = new CommandearticleArticleUtilisateur();
        if ($form->isSubmitted() && $form->isValid()) {
            $time = date('Y/m/d');
            $commandearticle ->setDatecommande($time);
            $commandearticleRepository->save($commandearticle, true);
            $commandearticleArticleUtilisateur -> setIdcommande($commandearticle -> getIdcommande());
            $commandearticleArticleUtilisateur -> setIdutilisateur(22);
            $commandearticleArticleUtilisateur ->setIdarticle($article -> getIdarticle());
            $commandearticleArticleUtilisateurRepository ->save($commandearticleArticleUtilisateur, true);
            // SMS


           $sid = "ACda633fc1b6c821502df86b8c5e29ce95";
                        $token = "7c0ba313acefb52845a986f24733fa5c";
                        $twilio = new Client($sid, $token);
                        $message = $twilio->messages
                            ->create("+21620542959", // to
                                array(
                                    "from" => "+15627844569",
                        "body" => "Equipe RAMCHA vous remercie pour votre confiance ! Votre commande (N°: ". $commandearticle->getIdcommande() . ") sera livrée en quelque jours. RESTEZ A L'ECOUTE !"
                                )
                            );


            return $this->redirectToRoute('viewpdfarticle', [
                'commande'=>$commandearticle->getIdcommande(),
                'utilisateur'=>$commandearticleArticleUtilisateur -> getIdutilisateur(),
                'bb'=>$commandearticleArticleUtilisateur -> getIdarticle(),
            ], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('commandearticle/new.html.twig', [
            'commandearticle' => $commandearticle,
            'form' => $form,
            'article' => $article,
        ]);
    }

    #[Route('/{idcommande}', name: 'app_commandearticle_show', methods: ['GET'])]
    public function show(Commandearticle $commandearticle): Response
    {
        return $this->render('commandearticle/show.html.twig', [
            'commandearticle' => $commandearticle,
        ]);
    }

    //Admin : Modifier une commande par l'admin
    #[Route('/{idcommande}/edit', name: 'app_commandearticle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commandearticle $commandearticle, CommandearticleRepository $commandearticleRepository): Response
    {
        $form = $this->createForm(CommandearticleType::class, $commandearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandearticleRepository->save($commandearticle, true);

            return $this->redirectToRoute('app_commandearticle_article_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commandearticle/edit.html.twig', [
            'commandearticle' => $commandearticle,
            'form' => $form,
        ]);
    }

    //Admin: Supprimer une commande article
    #[Route('/{idcommande}', name: 'app_commandearticle_delete', methods: ['POST'])]
    public function delete(Request $request, Commandearticle $commandearticle, CommandearticleRepository $commandearticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandearticle->getIdcommande(), $request->request->get('_token'))) {
            $commandearticle->setStatuslivraison("Rejetée");
            $commandearticleRepository->save($commandearticle, true);
        }

        return $this->redirectToRoute('app_commandearticle_article_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }

    //Client : Supprimer une commande article
    #[Route('/{idcommande}/{a}', name: 'app_commandearticle_eletecmd')]
    public function deleteutilcmd($a,Request $request, Commandearticle $commandearticle, CommandearticleRepository $commandearticleRepository)
    {
        if ($this->isCsrfTokenValid('delete'.$commandearticle->getIdcommande(), $request->request->get('_token'))) {
            $commandearticleRepository->remove($commandearticle, true);
        }

        return $this->redirectToRoute('app_commandearticle_article_utilisateur_cmdutil', ['id'=>$a], Response::HTTP_SEE_OTHER);
    }



}
