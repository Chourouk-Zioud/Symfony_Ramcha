<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commandearticle;
use App\Entity\Facture;
use App\Entity\Utilisateur;
use App\Form\FactureType;
use App\Repository\ArticleRepository;
use App\Repository\CommandearticleRepository;
use App\Repository\FactureRepository;
use App\Repository\UtilisateurRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\Result\PdfResult;
use Endroid\QrCode\Writer\SvgWriter;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Builder\BuilderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/{_locale}/facture')]
class FactureController extends AbstractController
{
    #[Route('/{idcommande}/{user}/{art}', name: 'app_facture_index')]
    public function index(FactureRepository $factureRepository,$idcommande,$user,$art)
    {
        return $this->render('facture/index.html.twig', [
            'idcommande'=>$idcommande,
            'art'=>$art,
            'user'=>$user,
        ]);
    }


    #[Route('/download/{utilisateur}/{art}/{commande}', name: 'downloadpdf')]
    public function download(FactureRepository $factureRepository,$commande,$utilisateur,$art,CommandearticleRepository $cmd, UtilisateurRepository $user,ArticleRepository $ar)
    {
        $u = $user->find($utilisateur);
        $c = $cmd->find($commande);
        $a = $ar->find($art);

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
        $html = $this->renderView('facture/downloadf.html.twig', [
            'a'=>$a,
            'u'=>$u,
            'c'=>$c
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $fichier = 'facture'.'.pdf';

        $dompdf->stream($fichier,[
            'Attachment'=>TRUE,
        ]);
        return new Response();
    }

    #[Route('/viewart/{utilisateur}/{bb}/{commande}', name: 'viewpdfarticle')]
    public function view(FactureRepository $factureRepository,$commande,$utilisateur,$bb,CommandearticleRepository $cmd, UtilisateurRepository $user,ArticleRepository $ar)
    {
        $u = $user->find($utilisateur);
        $c = $cmd->find($commande);
        $a = $ar->find($bb);

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
        $html = $this->renderView('facture/downloadf.html.twig', [
            'a'=>$a,
            'u'=>$u,
            'c'=>$c
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $fichier = 'facture'.'.pdf';

        //QR code

        $random = random_int(10000000,10000000000);
        $str = (string) $random;

        $pdf = $dompdf->output();
        $file_location = $_SERVER['DOCUMENT_ROOT']."uploads/brochures/".$str.".pdf";
        file_put_contents($file_location,$pdf);

        $facture = new Facture();
        $facture->setTotal($a->getPrixarticle()*1.05);
        $facture->setIdcommande($c->getIdcommande());
        $time = date('Y-m-d');
        $facture->setDatefacture($time);
        $facture->setIddevis(16);
        $facture->setFacturepdf($str);
        $factureRepository->save($facture,true);

        $utf8_string = utf8_encode(file_get_contents("uploads/brochures/".$str.".pdf"));

        $qrcode = Qrcode::create($html)
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $writer = new PngWriter();
        $qrCodes['simple'] = $writer->write(
            $qrcode,
        )->getDataUri();

        return $this->render('facture/view.html.twig',[
            'a'=>$a,
            'u'=>$u,
            'c'=>$c,
            'se'=>$qrCodes,
            'facture'=>$facture
        ]);
    }

}
