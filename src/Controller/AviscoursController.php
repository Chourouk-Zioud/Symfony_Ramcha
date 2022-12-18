<?php

namespace App\Controller;

use App\Entity\Aviscours;
use App\Form\AviscoursType;
use App\Repository\AviscoursRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/aviscours')]
class AviscoursController extends AbstractController
{
    #[Route('/client', name: 'app_aviscours_liste', methods: ['GET'])]
    public function indexclient(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Aviscours::class)->findAll();
        $offre = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            4);
        return $this->render('aviscours/index.html.twig', [
            'aviscours' => $offre,
        ]);
    }





    #[Route('/', name: 'app_aviscours_index', methods: ['GET'])]
    public function index(AviscoursRepository $aviscoursRepository): Response
    {
        return $this->render('aviscours/index.html.twig', [
            'aviscours' => $aviscoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_aviscours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AviscoursRepository $aviscoursRepository): Response
    {
        $aviscour = new Aviscours();
        $form = $this->createForm(AviscoursType::class, $aviscour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*$aviscour->getIdcours(5);*/
$aviscour->setIdutilisateur(5);
            $aviscoursRepository->save($aviscour, true);

            return $this->redirectToRoute('app_aviscours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aviscours/new.html.twig', [
            'aviscour' => $aviscour,
            'form' => $form,
        ]);
    }

    #[Route('/{idaviscours}', name: 'app_aviscours_show', methods: ['GET'])]
    public function show(Aviscours $aviscour): Response
    {
        return $this->render('aviscours/show.html.twig', [
            'aviscour' => $aviscour,
        ]);
    }

    #[Route('/{idaviscours}/edit', name: 'app_aviscours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Aviscours $aviscour, AviscoursRepository $aviscoursRepository): Response
    {
        $form = $this->createForm(AviscoursType::class, $aviscour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aviscoursRepository->save($aviscour, true);


            return $this->redirectToRoute('app_aviscours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aviscours/edit.html.twig', [
            'aviscour' => $aviscour,
            'form' => $form,
        ]);
    }

    #[Route('/{idaviscours}', name: 'app_aviscours_delete', methods: ['POST'])]
    public function delete(Request $request, Aviscours $aviscour, AviscoursRepository $aviscoursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aviscour->getIdaviscours(), $request->request->get('_token'))) {
            $aviscoursRepository->remove($aviscour, true);
        }

        return $this->redirectToRoute('app_aviscours_index', [], Response::HTTP_SEE_OTHER);
    }
}
