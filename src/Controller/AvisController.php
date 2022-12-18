<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\ArticleRepository;
use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/avis')]
class AvisController extends AbstractController
{
    ####################### FRONT ##############################

    #[Route('/front/', name: 'app_avis_index_front', methods: ['GET'])]
    public function index(PaginatorInterface $paginator,AvisRepository $avisRepository,Request $request): Response
    {
        // Paginate the results of the query
        $data=$avisRepository->findAll();
        $avi =$paginator->paginate(
        // Doctrine Query, not results
            $data,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4);
        return $this->render('avis/indexfront.html.twig', [
            'avis' => $avisRepository->findAll(),
            'avi' => $avi,
        ]);
    }

    #[Route('/front/new/{id}', name: 'app_avisart_new_front', methods: ['GET', 'POST'])]
    public function newrx($id,ArticleRepository $articleRepository,Request $request, AvisRepository $avisRepository): Response
    {
        $avis = new Avis();
        $avis->setIdarticle($id);
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avisRepository->save($avis, true);

            return $this->redirectToRoute('app_article_index_front' , [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/newavisarticle.html.twig', [
            'avi' => $avis,
            'form' => $form,
        ]);
    }

    #[Route('/front/new', name: 'app_avis_new_front', methods: ['GET', 'POST'])]
    public function new(Request $request, AvisRepository $avisRepository): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avisRepository->save($avi, true);

            return $this->redirectToRoute('app_avis_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/newfront.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idavis}', name: 'app_avis_show_front', methods: ['GET'])]
    public function show(Avis $avi): Response
    {
        return $this->render('avis/showfront.html.twig', [
            'avi' => $avi,
        ]);
    }

    #[Route('/front/{idavis}/edit', name: 'app_avis_edit_front', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avis $avi, AvisRepository $avisRepository): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avisRepository->save($avi, true);

            return $this->redirectToRoute('app_avis_index_front', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/editfront.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/front/{idavis}', name: 'app_avis_delete_front', methods: ['POST'])]
    public function delete(Request $request, Avis $avi, AvisRepository $avisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getIdavis(), $request->request->get('_token'))) {
            $avisRepository->remove($avi, true);
        }

        return $this->redirectToRoute('app_avis_index_front', [], Response::HTTP_SEE_OTHER);
    }


    ####################### BACK ##############################


    #[Route('/back/', name: 'app_avis_index_back', methods: ['GET'])]
    public function indexback(AvisRepository $avisRepository): Response
    {
        return $this->render('avis/indexback.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }

    #[Route('/back/new', name: 'app_avis_new_back', methods: ['GET', 'POST'])]
    public function newback(Request $request, AvisRepository $avisRepository): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avisRepository->save($avi, true);

            return $this->redirectToRoute('app_avis_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/newback.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idavis}', name: 'app_avis_show_back', methods: ['GET'])]
    public function showback(Avis $avi): Response
    {
        return $this->render('avis/showback.html.twig', [
            'avi' => $avi,
        ]);
    }

    #[Route('/back/{idavis}/edit', name: 'app_avis_edit_back', methods: ['GET', 'POST'])]
    public function editback(Request $request, Avis $avi, AvisRepository $avisRepository): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avisRepository->save($avi, true);

            return $this->redirectToRoute('app_avis_index_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/editback.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/back/{idavis}', name: 'app_avis_delete_back', methods: ['POST'])]
    public function deleteback(Request $request, Avis $avi, AvisRepository $avisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getIdavis(), $request->request->get('_token'))) {
            $avisRepository->remove($avi, true);
        }

        return $this->redirectToRoute('app_avis_index_back', [], Response::HTTP_SEE_OTHER);
    }

}
