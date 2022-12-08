<?php

namespace App\Controller;

use App\Entity\Commandeservice;
use App\Entity\Devisservice;
use App\Form\CmdSerType;
use App\Form\DevisserviceType;
use App\Repository\CommandeserviceRepository;
use App\Repository\DevisserviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;
use Dompdf\Options;
use Dompdf\Dompdf;

#[Route('/{_locale}/devisservice')]
class DevisserviceController extends AbstractController
{
    #[Route('/devisservice/{idservice}', name: 'app_devisservice_index')]
    public function index(DevisserviceRepository $devisRepository , CommandeserviceRepository $repcmd,Service $service,Request $req)
    {

        $devisser = new Devisservice();
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont','Arial');
        $pdfOptions->setIsRemoteEnabled(true);


        $time = date('Y-m-d');
        $devisser->setDatedevis($time);
        $devisser->setTotal($service->getPrixservice());
        $devisser->setIdcommandesevice(15);
        $devisRepository->save($devisser,true);

        $dompdf= new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl'=>[
                'verify_peer'=>FALSE,
                'verify_peer_name'=>FALSE,
                'allow_self_signed'=>TRUE,
            ]
        ]);
        $dompdf->setHttpContext($context);
        // génere le html
        $html = $this->renderView('devisservice/download.html.twig',[
            'service'=>$service,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $fichier = 'devis'.'.pdf';
        $dompdf->stream($fichier,[
            'Attachment'=>TRUE,
        ]);
        return new Response();
    }
}
