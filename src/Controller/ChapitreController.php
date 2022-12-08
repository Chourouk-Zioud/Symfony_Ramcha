<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\CoursFirst;
use App\Form\ChapitreType;
use App\Repository\ChapitreRepository;
use App\Repository\CoursFirstRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/chapitre')]
class ChapitreController extends AbstractController
{
    #[Route('/client', name: 'app_chapitre_liste', methods: ['GET'])]
    public function indexclient(ChapitreRepository $chapitreRepository): Response
    {
        return $this->render('chapitre/indexclient.html.twig', [
            'chapitre' => $chapitreRepository->findAll(),
        ]);
    }
    #[Route('/', name: 'app_chapitre_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {$donnees=$this->getDoctrine()->getRepository(Chapitre::class)->findAll();
$offre=$paginator->paginate(
    $donnees,
    $request->query->getInt('page',1),2);

        return $this->render('chapitre/index.html.twig', [
            'chapitre' => $offre,
        ]);
    }

    #[Route('/new', name: 'app_chapitre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChapitreRepository $chapitreRepository , CoursFirstRepository $coursFirstRepository): Response
    {
        $chapitre = new Chapitre();

        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapitreRepository->save($chapitre, true);




            return $this->redirectToRoute('app_chapitre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chapitre/new.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form,
        ]);
    }


    #[Route('/{idChapitre}', name: 'app_chapitre_show', methods: ['GET'])]
    public function show(Chapitre $chapitre): Response
    {
        return $this->render('chapitre/show.html.twig', [
            'chapitre' => $chapitre,
        ]);
    }

    #[Route('/{idChapitre}/edit', name: 'app_chapitre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chapitre $chapitre, ChapitreRepository $chapitreRepository): Response
    {
        $form = $this->createForm(ChapitreType::class, $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chapitreRepository->save($chapitre, true);

            return $this->redirectToRoute('app_chapitre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chapitre/edit.html.twig', [
            'chapitre' => $chapitre,
            'form' => $form,
        ]);
    }

    #[Route('/{idChapitre}', name: 'app_chapitre_delete', methods: ['POST'])]
    public function delete(Request $request, Chapitre $chapitre, ChapitreRepository $chapitreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chapitre->getidChapitre(), $request->request->get('_token'))) {
            $chapitreRepository->remove($chapitre, true);
        }

        return $this->redirectToRoute('app_chapitre_index', [], Response::HTTP_SEE_OTHER);
    }
}
