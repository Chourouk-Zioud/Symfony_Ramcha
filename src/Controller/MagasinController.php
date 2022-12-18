<?php

namespace App\Controller;

use App\Entity\Magasin;
use App\Form\MagasinType;
use App\Repository\MagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/magasin')]
class MagasinController extends AbstractController
{
    ####################### FRONT ##############################

    #[Route('/front/', name: 'app_magasin_index_front', methods: ['GET'])]
    public function index(MagasinRepository $magasinRepository): Response
    {
        return $this->render('magasin/indexfront.html.twig', [
            'magasins' => $magasinRepository->findAll(),
        ]);
    }

    #[Route('/front/new', name: 'app_magasin_new_front', methods: ['GET', 'POST'])]
    public function new(Request $request, MagasinRepository $magasinRepository): Response
    {
        $magasin = new Magasin();
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $magasinRepository->save($magasin, true);

            return $this->redirectToRoute('app_magasin_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('magasin/newfront.html.twig', [
            'magasin' => $magasin,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idmagasin}', name: 'app_magasin_show_front', methods: ['GET'])]
    public function show(Magasin $magasin): Response
    {
        return $this->render('magasin/showfront.html.twig', [
            'magasin' => $magasin,
        ]);
    }

    #[Route('/front/{idmagasin}/edit', name: 'app_magasin_edit_front', methods: ['GET', 'POST'])]
    public function edit(Request $request, Magasin $magasin, MagasinRepository $magasinRepository): Response
    {
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $magasinRepository->save($magasin, true);

            return $this->redirectToRoute('app_magasin_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('magasin/editfront.html.twig', [
            'magasin' => $magasin,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idmagasin}', name: 'app_magasin_delete_front', methods: ['POST'])]
    public function delete(Request $request, Magasin $magasin, MagasinRepository $magasinRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magasin->getIdmagasin(), $request->request->get('_token'))) {
            $magasinRepository->remove($magasin, true);
        }

        return $this->redirectToRoute('app_magasin_index_front', [], Response::HTTP_SEE_OTHER);
    }


    ####################### BACK ##############################

    #[Route('/back/', name: 'app_magasin_index_back', methods: ['GET'])]
    public function indexback(MagasinRepository $magasinRepository): Response
    {
        return $this->render('magasin/indexback.html.twig', [
            'magasins' => $magasinRepository->findAll(),
        ]);
    }

    #[Route('/back/new', name: 'app_magasin_new_back', methods: ['GET', 'POST'])]
    public function newback(Request $request, MagasinRepository $magasinRepository): Response
    {
        $magasin = new Magasin();
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $magasinRepository->save($magasin, true);

            return $this->redirectToRoute('app_magasin_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('magasin/newback.html.twig', [
            'magasin' => $magasin,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idmagasin}', name: 'app_magasin_show_back', methods: ['GET'])]
    public function showback(Magasin $magasin): Response
    {
        return $this->render('magasin/showback.html.twig', [
            'magasin' => $magasin,
        ]);
    }

    #[Route('/back/{idmagasin}/edit', name: 'app_magasin_edit_back', methods: ['GET', 'POST'])]
    public function editback(Request $request, Magasin $magasin, MagasinRepository $magasinRepository): Response
    {
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $magasinRepository->save($magasin, true);

            return $this->redirectToRoute('app_magasin_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('magasin/editback.html.twig', [
            'magasin' => $magasin,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idmagasin}', name: 'app_magasin_delete_back', methods: ['POST'])]
    public function deleteback(Request $request, Magasin $magasin, MagasinRepository $magasinRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magasin->getIdmagasin(), $request->request->get('_token'))) {
            $magasinRepository->remove($magasin, true);
        }

        return $this->redirectToRoute('app_magasin_index_back', [], Response::HTTP_SEE_OTHER);
    }
}
