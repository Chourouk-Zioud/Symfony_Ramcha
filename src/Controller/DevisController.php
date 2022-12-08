<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Devis;
use App\Repository\CommandearticleRepository;
use App\Repository\DevisRepository;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Options;


#[Route('/{_locale}/devis')]
class DevisController extends AbstractController
{

    #[Route('/devis/{idarticle}', name: 'app_devis_index')]
    public function index(DevisRepository $devisRepository , CommandearticleRepository $repcmd,Article $article)
    {
        $devis = new Devis();
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont','Arial');
        $pdfOptions->setIsRemoteEnabled(true);
        $time = date('Y-m-d');
        $devis->setDatedevis($time);
        $devis->setTotalht($article->getPrixarticle());
        $devis->setTotal($article->getPrixarticle()*1.05);
        $devis->setIdcommande(15);
        $devisRepository->save($devis,true);
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
        $html = $this->renderView('devis/download.html.twig',[
            'article'=>$article
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
