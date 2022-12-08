<?php

namespace App\Controller;

use App\Entity\PropertSearch;
use App\Entity\Service;
use App\Form\PropertSearchType;
use App\Form\SeditType;
use App\Form\ServiceType;
use App\Repository\CategorieserviceRepository;
use App\Repository\ServiceRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Color\Color;
#[Route('/{_locale}/service')]
class ServiceController extends AbstractController
{
    #[Route('/', name: 'app_service_index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository, CategorieserviceRepository $categorieserviceRepository,Request $request, PaginatorInterface $paginator): Response

    {
        $donnees = $this->getDoctrine()->getRepository(Service::class)->findAll();
        $us= $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/);
        return $this->render('service/index.html.twig', [
            'services' => $us,
            'categorie'=> $categorieserviceRepository,
            'us' => $us
        ]);
    }

    #[Route('/choix', name: 'app_service_liste', methods: ['GET'])]
    public function indexclient( Request $request, PaginatorInterface $paginator ): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Service::class)->findAll();
        $offre= $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/);

        return $this->render('service/indexclient.html.twig', [
            'services' => $offre
        ]);
    }
    #[Route('/new', name: 'app_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ServiceRepository $serviceRepository,CategorieserviceRepository $categorieserviceRepository): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $serviceRepository->save($service, true);
            //$serviceRepository->sendsms();


            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }
    #[Route('/accEv', name: 'app_club')]
    public function front(): Response
    {
        return $this->render('base_fronteya.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/{idservice}', name: 'app_service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{idservice}/edit', name: 'app_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Service $service, ServiceRepository $serviceRepository): Response
    {
        $form = $this->createForm(SeditType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceRepository->save($service, true);

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{idservice}', name: 'app_service_delete', methods: ['POST'])]
    public function delete(Request $request, Service $service, ServiceRepository $serviceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getIdservice(), $request->request->get('_token'))) {
            $serviceRepository->remove($service, true);
        }

        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/search', name: 'Ajax_search',methods: ['GET'])]
    public function searchAction(Request $request, OffreRepository $repo)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $challenges =  $repo->findEntitiesByString($requestString);

        if(!$challenges) {
            $result['challenges']['error'] = " ⚠   Aucun Challenges n'a été trouvé! ";
        } else {
            $result['challenges'] = $this->getRealEntities($challenges);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($challenges )
    {
        $em = $this->getDoctrine()->getRepository(Service::class);
        foreach ($challenges as $challange) {

            $realEntities[$challange->getId()] = [$challange->getId(), $challange->getNomservice(), $challange->getPrixservice(), $challange->getDescriptionservice()
                , $challange->getDatedebutservice(), $challange-> getDatefinservice(), $challange->getDisponibiliteservice()];
        }
        return $realEntities;


    }
}
