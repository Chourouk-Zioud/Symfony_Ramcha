<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReclamationType;
use App\Repository\ArticleRepository;
use App\Repository\ReclamationRepository;
use App\Repository\ReponseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    ####################### FRONT ##############################

    #[Route('/front/', name: 'app_reclamation_index_front', methods: ['GET'])]
    public function index(PaginatorInterface $paginator,Request $request,ReclamationRepository $reclamationRepository): Response
    {
        // Paginate the results of the query
        $data=$reclamationRepository->findAll();
        $reclamations =$paginator->paginate(
        // Doctrine Query, not results
            $data,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3);
        return $this->render('reclamation/indexfront.html.twig', [
            'reclamations' => $reclamations,

        ]);
    }

    #[Route('/front/new', name: 'app_reclamation_new_front', methods: ['GET', 'POST'])]
    public function new(Request $request, ReclamationRepository $reclamationRepository,MailerInterface $mailer): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);


            $maile=[];
            $msg= $reclamation->getDescription();
            $email = (new Email())
                ->from('539da53abe94bb@smtp.mailtrap.io')
                ->to('kais.chalghoumi@esprit.tn')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Nouvelle Reclamation!')
                ->text('Important!')
                ->html(`<p>$msg</p>`);

            $mailer->send($email);


            return $this->redirectToRoute('app_reclamation_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/newfront.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,array("form"=>$form->createView())
        ]);
    }

    #[Route('/front/{idreclamation}', name: 'app_reclamation_show_front', methods: ['GET'])]
    public function show(Reclamation $reclamation,$idreclamation,ReponseRepository $reponseRepository): Response
    {
        $reponse = $reponseRepository->findByIdRec($idreclamation);
        $nbr = count($reponse);
        return $this->render('reclamation/showfront.html.twig', [
            'reclamation' => $reclamation,
            'reponse' => $reponse,
            'nbr' => $nbr
        ]);
    }

    #[Route('/front/{idreclamation}/edit', name: 'app_reclamation_edit_front', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/editfront.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idreclamation}', name: 'app_reclamation_delete_front', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdreclamation(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation, true);
        }

        return $this->redirectToRoute('app_reclamation_index_front', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('front/{id}', name: 'remove')]
    public function deleterec(ManagerRegistry $doctrine, ReclamationRepository $repo,$id): Response
    {
        $em=$doctrine->getManager();
        $result=$repo->find($id);
        $em->remove($result);
        $em->flush();

        return $this->redirectToRoute('app_reclamation_index_front');
    }


    ####################### BACK ##############################

    #[Route('/back/', name: 'app_reclamation_index_back', methods: ['GET'])]
    public function indexback(PaginatorInterface $paginator,Request $request,ReclamationRepository $reclamationRepository): Response
    {
        // Paginate the results of the query
        $data=$reclamationRepository->findAll();
        $reclamations =$paginator->paginate(
        // Doctrine Query, not results
            $data,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3);
        return $this->render('reclamation/indexback.html.twig', [
            'reclamations' => $reclamations,

        ]);
    }

    #[Route('/back/new', name: 'app_reclamation_new_back', methods: ['GET', 'POST'])]
    public function newback(Request $request, ReclamationRepository $reclamationRepository): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/newback.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idreclamation}', name: 'app_reclamation_show_back', methods: ['GET'])]
    public function showback(Reclamation $reclamation,$idreclamation,ReponseRepository $reponseRepository): Response
    {
        $reponse = $reponseRepository->findByIdRec($idreclamation);
        $nbr = count($reponse);
        return $this->render('reclamation/showback.html.twig', [
            'reclamation' => $reclamation,
            'reponse' => $reponse,
            'nbr' => $nbr
        ]);
    }

    #[Route('/back/{idreclamation}/edit', name: 'app_reclamation_edit_back', methods: ['GET', 'POST'])]
    public function editback(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamationRepository->save($reclamation, true);

            return $this->redirectToRoute('app_reclamation_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/editback.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idreclamation}', name: 'app_reclamation_delete_back', methods: ['POST'])]
    public function deleteback(Request $request, Reclamation $reclamation, ReclamationRepository $reclamationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getIdreclamation(), $request->request->get('_token'))) {
            $reclamationRepository->remove($reclamation, true);
        }

        return $this->redirectToRoute('app_reclamation_index_back', [], Response::HTTP_SEE_OTHER);
    }
}

