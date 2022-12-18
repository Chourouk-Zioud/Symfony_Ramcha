<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\ReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reponse')]
class ReponseController extends AbstractController
{
    ############################# FRONT #########################################""""

    #[Route('/front/', name: 'app_reponse_index_front', methods: ['GET'])]
    public function index(ReponseRepository $reponseRepository): Response
    {
        return $this->render('reponse/indexfront.html.twig', [
            'reponses' => $reponseRepository->findAll(),
        ]);
    }

    #[Route('/front/new/{idrec}', name: 'app_reponserec_new_front', methods: ['GET', 'POST'])]
    public function newrr($idrec,Request $request, ReponseRepository $reponseRepository): Response
    {
        $reponse = new Reponse();
        $reponse->setIdreclamation($idrec);
        $reponse->setPrenom("Achref");
        $reponse->setDaterep(new \DateTime('now'));
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponseRepository->save($reponse, true);

            return $this->redirectToRoute('app_reclamation_index_front' , [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/newfront.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idreponse}', name: 'app_reponse_show_front', methods: ['GET'])]
    public function show(Reponse $reponse): Response
    {
        return $this->render('reponse/showfront.html.twig', [
            'reponse' => $reponse,
        ]);
    }

    #[Route('/front/{idreponse}/edit', name: 'app_reponse_edit_front', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reponse $reponse, ReponseRepository $reponseRepository): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponseRepository->save($reponse, true);

            return $this->redirectToRoute('app_reponse_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/editfront.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idreponse}', name: 'app_reponse_delete_front', methods: ['POST'])]
    public function delete(Request $request, Reponse $reponse, ReponseRepository $reponseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponse->getIdreponse(), $request->request->get('_token'))) {
            $reponseRepository->remove($reponse, true);
        }

        return $this->redirectToRoute('app_reponse_index_front', [], Response::HTTP_SEE_OTHER);
    }

    ############################# BACK #########################################""""

    #[Route('/back/', name: 'app_reponse_index_back', methods: ['GET'])]
    public function indexback(ReponseRepository $reponseRepository): Response
    {
        return $this->render('reponse/indexback.html.twig', [
            'reponses' => $reponseRepository->findAll(),
        ]);
    }

    #[Route('/back/new', name: 'app_reponse_new_back', methods: ['GET', 'POST'])]
    public function newback(Request $request, ReponseRepository $reponseRepository): Response
    {
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponseRepository->save($reponse, true);

            return $this->redirectToRoute('app_reponse_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/newback.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idreponse}', name: 'app_reponse_show_back', methods: ['GET'])]
    public function showback(Reponse $reponse): Response
    {
        return $this->render('reponse/showback.html.twig', [
            'reponse' => $reponse,
        ]);
    }

    #[Route('/back/{idreponse}/edit', name: 'app_reponse_edit_back', methods: ['GET', 'POST'])]
    public function editback(Request $request, Reponse $reponse, ReponseRepository $reponseRepository): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponseRepository->save($reponse, true);

            return $this->redirectToRoute('app_reponse_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/editback.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idreponse}', name: 'app_reponse_delete_back', methods: ['POST'])]
    public function deleteback(Request $request, Reponse $reponse, ReponseRepository $reponseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponse->getIdreponse(), $request->request->get('_token'))) {
            $reponseRepository->remove($reponse, true);
        }

        return $this->redirectToRoute('app_reponse_index_back', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/back/new/{idrec}', name: 'app_reponserec_new_back', methods: ['GET', 'POST'])]
    public function newrrb($idrec,Request $request, ReponseRepository $reponseRepository): Response
    {
        $reponse = new Reponse();
        $reponse->setIdreclamation($idrec);
        $reponse->setPrenom("admin");
        $reponse->setDaterep(new \DateTime('now'));
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reponseRepository->save($reponse, true);

            return $this->redirectToRoute('app_reclamation_index_back' , [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/newback.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

}
