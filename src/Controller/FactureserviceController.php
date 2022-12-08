<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\Factureservice;
use App\Form\FactureserviceType;
use App\Repository\CommandeserviceRepository;
use App\Repository\DevisserviceRepository;
use App\Repository\FactureserviceRepository;
use App\Repository\ServiceRepository;
use App\Repository\UtilisateurRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{_locale}/factureservice')]
class FactureserviceController extends AbstractController
{
    #[Route('/{idcommandeservice}/{user}/{ser}', name: 'app_factureservice_index')]
    public function index(FactureserviceRepository $factureserviceRepository,$idcommandeservice,$user,$ser)
    {
        return $this->render('factureservice/index.html.twig', [
            'idcommandeservice'=>$idcommandeservice,
            'ser'=>$ser,
            'user'=>$user,
        ]);
    }

    #[Route('/download/{utilisateur}/{ser}/{commande}', name: 'downloadpdfservice')]
    public function new(Request $request, FactureserviceRepository $factureserviceRepository, $commande,$utilisateur,$ser,CommandeserviceRepository $cmd,UtilisateurRepository $user, ServiceRepository $se )
    {
        $u = $user->find($utilisateur);
        $c = $cmd->find($commande);
        $s = $se->find($ser);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont','Arial');
        $pdfOptions->setIsRemoteEnabled(true);

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
        $html = $this->renderView('factureservice/downloadf.html.twig', [
            's'=>$s,
            'u'=>$u,
            'c'=>$c
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $fichier = 'facture'.'.pdf';
        ob_get_clean();


        $dompdf->stream($fichier,[
            'Attachment'=>true,
        ]);
        return new Response();
    }

    #[Route('/view/{utilisateur}/{bb}/{commande}', name: 'viewpdfservice')]
    public function view(Request $request, FactureserviceRepository $factureserviceRepository, $commande,$utilisateur,$bb,CommandeserviceRepository $cmd,UtilisateurRepository $user, ServiceRepository $se )
    {
        $u = $user->find($utilisateur);
        $c = $cmd->find($commande);
        $s = $se->find($bb);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont','Arial');
        $pdfOptions->setIsRemoteEnabled(true);


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
        $html = $this->renderView('factureservice/downloadf.html.twig', [
            's'=>$s,
            'u'=>$u,
            'c'=>$c
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $fichier = 'facture'.'.pdf';


        //QR code
        $writer = new PngWriter();
        $qrcode = QrCode::create($html)
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $qrCodes['simple'] = $writer->write(
            $qrcode,
        )->getDataUri();


        $random = random_int(10000000,10000000000);
        $str = (string) $random;

        $pdf = $dompdf->output();
        $file_location = $_SERVER['DOCUMENT_ROOT']."uploads/brochures/".$str."service.pdf";
        file_put_contents($file_location,$pdf);

        $facture = new Factureservice();
        $time = date('Y-m-d');
        $facture->setDatefacture($time);
        $facture->setTotal($c->getNbjour()*$s->getPrixservice());
        $facture->setIdcommandeservice($c->getIdcommandeservice());
        $facture->setIddevisservice($s->getIdservice());
        $facture->setFactureservicepdf($str);
        $factureserviceRepository->save($facture,true);

        return $this->render('factureservice/view.html.twig', [
            's'=>$s,
            'u'=>$u,
            'c'=>$c,
            'se'=>$qrCodes,
            'facture'=>$facture,

        ]);

    }
}
