<?php

namespace App\Controller;

use App\Entity\Categoriearticle;
use App\Form\CategoriearticleType;
use App\Repository\CategoriearticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categoriearticle')]
class CategoriearticleController extends AbstractController
{
    ####################### FRONT ##############################

    #[Route('/front/', name: 'app_categoriearticle_index_front', methods: ['GET'])]
    public function index(CategoriearticleRepository $categoriearticleRepository): Response
    {
        return $this->render('categoriearticle/indexfront.html.twig', [
            'categoriearticles' => $categoriearticleRepository->findAll(),
        ]);
    }

    #[Route('/front/new', name: 'app_categoriearticle_new_front', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriearticleRepository $categoriearticleRepository): Response
    {
        $categoriearticle = new Categoriearticle();
        $form = $this->createForm(CategoriearticleType::class, $categoriearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriearticleRepository->save($categoriearticle, true);

            return $this->redirectToRoute('app_categoriearticle_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriearticle/newfront.html.twig', [
            'categoriearticle' => $categoriearticle,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idcategorie}', name: 'app_categoriearticle_show_front', methods: ['GET'])]
    public function show(Categoriearticle $categoriearticle): Response
    {
        return $this->render('categoriearticle/showfront.html.twig', [
            'categoriearticle' => $categoriearticle,
        ]);
    }

    #[Route('/front/{idcategorie}/edit', name: 'app_categoriearticle_edit_front', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categoriearticle $categoriearticle, CategoriearticleRepository $categoriearticleRepository): Response
    {
        $form = $this->createForm(CategoriearticleType::class, $categoriearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriearticleRepository->save($categoriearticle, true);

            return $this->redirectToRoute('app_categoriearticle_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriearticle/editfront.html.twig', [
            'categoriearticle' => $categoriearticle,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idcategorie}', name: 'app_categoriearticle_delete_front', methods: ['POST'])]
    public function delete(Request $request, Categoriearticle $categoriearticle, CategoriearticleRepository $categoriearticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriearticle->getIdcategorie(), $request->request->get('_token'))) {
            $categoriearticleRepository->remove($categoriearticle, true);
        }

        return $this->redirectToRoute('app_categoriearticle_index_front', [], Response::HTTP_SEE_OTHER);
    }


    ####################### BACK ##############################

    #[Route('/back/', name: 'app_categoriearticle_index_back', methods: ['GET'])]
    public function indexback(PaginatorInterface $paginator,Request $request,CategoriearticleRepository $categoriearticleRepository): Response
    {
        // Paginate the results of the query
        $data=$categoriearticleRepository->findAll();
        $categoriearticles =$paginator->paginate(
        // Doctrine Query, not results
            $data,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5);
        return $this->render('categoriearticle/indexback.html.twig', [
            'categoriearticles' => $categoriearticles,

        ]);
    }

    #[Route('/back/new', name: 'app_categoriearticle_new_back', methods: ['GET', 'POST'])]
    public function newback(Request $request, CategoriearticleRepository $categoriearticleRepository): Response
    {
        $categoriearticle = new Categoriearticle();
        $form = $this->createForm(CategoriearticleType::class, $categoriearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriearticleRepository->save($categoriearticle, true);

            return $this->redirectToRoute('app_categoriearticle_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriearticle/newback.html.twig', [
            'categoriearticle' => $categoriearticle,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idcategorie}', name: 'app_categoriearticle_show_back', methods: ['GET'])]
    public function showback(Categoriearticle $categoriearticle): Response
    {
        return $this->render('categoriearticle/showback.html.twig', [
            'categoriearticle' => $categoriearticle,
        ]);
    }

    #[Route('/back/{idcategorie}/edit', name: 'app_categoriearticle_edit_back', methods: ['GET', 'POST'])]
    public function editback(Request $request, Categoriearticle $categoriearticle, CategoriearticleRepository $categoriearticleRepository): Response
    {
        $form = $this->createForm(CategoriearticleType::class, $categoriearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriearticleRepository->save($categoriearticle, true);

            return $this->redirectToRoute('app_categoriearticle_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriearticle/editback.html.twig', [
            'categoriearticle' => $categoriearticle,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idcategorie}', name: 'app_categoriearticle_delete_back', methods: ['POST'])]
    public function deleteback(Request $request, Categoriearticle $categoriearticle, CategoriearticleRepository $categoriearticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriearticle->getIdcategorie(), $request->request->get('_token'))) {
            $categoriearticleRepository->remove($categoriearticle, true);
        }

        return $this->redirectToRoute('app_categoriearticle_index_back', [], Response::HTTP_SEE_OTHER);
    }
}
