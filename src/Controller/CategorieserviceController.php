<?php

namespace App\Controller;

use App\Entity\Categorieservice;
use App\Form\CategorieserviceType;
use App\Repository\CategorieserviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale}/categorieservice')]
class CategorieserviceController extends AbstractController
{
    #[Route('/', name: 'app_categorieservice_index', methods: ['GET'])]
    public function index(CategorieserviceRepository $categorieserviceRepository): Response
    {
        return $this->render('categorieservice/index.html.twig', [
            'categorieservices' => $categorieserviceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorieservice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategorieserviceRepository $categorieserviceRepository): Response
    {
        $categorieservice = new Categorieservice();
        $form = $this->createForm(CategorieserviceType::class, $categorieservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieserviceRepository->save($categorieservice, true);

            return $this->redirectToRoute('app_categorieservice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorieservice/new.html.twig', [
            'categorieservice' => $categorieservice,
            'form' => $form,
        ]);
    }

    #[Route('/{idcategorieservice}', name: 'app_categorieservice_show', methods: ['GET'])]
    public function show(Categorieservice $categorieservice): Response
    {
        return $this->render('categorieservice/show.html.twig', [
            'categorieservice' => $categorieservice,
        ]);
    }

    #[Route('/{idcategorieservice}/edit', name: 'app_categorieservice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorieservice $categorieservice, CategorieserviceRepository $categorieserviceRepository): Response
    {
        $form = $this->createForm(CategorieserviceType::class, $categorieservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieserviceRepository->save($categorieservice, true);

            return $this->redirectToRoute('app_categorieservice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorieservice/edit.html.twig', [
            'categorieservice' => $categorieservice,
            'form' => $form,
        ]);
    }

    #[Route('/{idcategorieservice}', name: 'app_categorieservice_delete', methods: ['POST'])]
    public function delete(Request $request, Categorieservice $categorieservice, CategorieserviceRepository $categorieserviceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieservice->getIdcategorieservice(), $request->request->get('_token'))) {
            $categorieserviceRepository->remove($categorieservice, true);
        }

        return $this->redirectToRoute('app_categorieservice_index', [], Response::HTTP_SEE_OTHER);
    }
}
