<?php

namespace App\Controller;

use App\Entity\CoursFirst;
use App\Form\CoursFirstType;
use App\Repository\CoursFirstRepository;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

#[Route('/{_locale}/cours/first')]
class CoursFirstController extends AbstractController
{
    #[Route('/', name: 'app_cours_first_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator ): Response
    {$donnees = $this->getDoctrine()->getRepository(CoursFirst::class)->findAll();
        $offre = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            4);
        return $this->render('cours_first/index.html.twig', [
            'cours_firsts' => $offre,
        ]);
    }
    #[Route('/client', name: 'app_cours_first_liste', methods: ['GET'])]
    public function indexclient(Request $request, PaginatorInterface $paginator): Response
    {$donnees = $this->getDoctrine()->getRepository(CoursFirst::class)->findAll();
        $offre = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6);

        return $this->render('cours_first/indexclient.html.twig', [
            'cours_firsts' => $offre,
        ]);
    }

    #[Route('/new', name: 'app_cours_first_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CoursFirstRepository $coursFirstRepository, MailerInterface $mailer): Response
    {
        $coursFirst = new CoursFirst();
        $form = $this->createForm(CoursFirstType::class, $coursFirst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $coursFirstRepository->save($coursFirst, true);
           //mailing/
           /* $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->CharSet = "utf-8";// set charset to utf8
            $mail->SMTPAuth = true;// Enable SMTP authentication
            $mail->SMTPSecure = 'tls';// Enable TLS encryption, ssl also accepted

            $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
            $mail->Port = 587;// TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isHTML(true);// Set email format to HTML

            $mail->Username = 'eya.tizaoui@esprit.tn';// SMTP username
            $mail->Password = 'eyatizaoui123456789';// SMTP password

            $mail->setFrom('eya.tizaoui@esprit.tn', 'Eya Tizaoui');//Your application NAME and EMAIL
            $mail->Subject = 'Un cours a ete ajouter';//Message subject
            //echo $request->request->get('nomA');
            // $mail->MsgHTML('bien créer');// Message body
            $mail->Body = '<h1>Cours: ' . $coursFirst->getNomcours(). 'Un cours a ete ajouter</h1>';

            $mail->addAddress('eya.tizaoui@esprit.tn', 'Eya Tizaoui');// Target email


            $mail->send();


*/
            $html=$this->renderView('cours_first/email.html.twig');
            $email=(new Email())
                    ->from('Ramcha@gmail.com')
                    ->to('exemple@gmail.com')
                    ->subject("Ajout d'un cours")
                    ->html($html);

            $mailer->send($email);




            return $this->redirectToRoute('app_cours_first_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours_first/new.html.twig', [
            'cours_first' => $coursFirst,
            'form' => $form,
        ]);
    }

    #[Route('/{idfirst}', name: 'app_cours_first_show', methods: ['GET'])]
    public function show(CoursFirst $coursFirst): Response
    {
        return $this->render('cours_first/show.html.twig', [
            'cours_first' => $coursFirst,
        ]);
    }

    #[Route('/{idfirst}/edit', name: 'app_cours_first_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CoursFirst $coursFirst, CoursFirstRepository $coursFirstRepository): Response
    {
        $form = $this->createForm(CoursFirstType::class, $coursFirst);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coursFirstRepository->save($coursFirst, true);

            return $this->redirectToRoute('app_cours_first_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours_first/edit.html.twig', [
            'cours_first' => $coursFirst,
            'form' => $form,
        ]);
    }

    #[Route('/{idfirst}', name: 'app_cours_first_delete', methods: ['POST'])]
    public function delete(Request $request, CoursFirst $coursFirst, CoursFirstRepository $coursFirstRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coursFirst->getIdfirst(), $request->request->get('_token'))) {
            $coursFirstRepository->remove($coursFirst, true);
        }

        return $this->redirectToRoute('app_cours_first_index', [], Response::HTTP_SEE_OTHER);
    }
}
