<?php

namespace App\Controller;
use App\Entity\Log;
use App\Entity\Service;
use App\Entity\Utilisateur;
use App\Form\DemandeurType;
use App\Form\LoginType;
use App\Form\LogType;
use App\Form\PrestateurType;
use App\Form\ResetType;
use App\Form\UtilisateurType;
use App\Form\UtilType;
use App\Form\VerifyType;
use App\Repository\CommandearticleArticleUtilisateurRepository;
use App\Repository\CommandeserviceServiceUtilisateurRepository;
use App\Service\SendEmail;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twilio\Rest\Client;
use  Scheb\TwoFactorBundle\Security\TwoFactor\Provider\TwoFactorFormRendererInterface;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;



#[Route('/{_locale}/utilisateur')]
class UtilisateurController extends AbstractController
{



    #[Route('/delu/{id}', name: 'app_utilisateur_delete')]
    public function delete(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getIduser(), $request->request->get('_token'))) {
            $utilisateurRepository->remove($utilisateur, true);
        }

        return $this->redirectToRoute('app_utilisateur_index');
    }

    #[Route('/show/{id}', name: 'app_utilisateur_showuser', methods: ['GET'])]
    public function show(Utilisateur $utilisateur):Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }


    #[Route('/new', name: 'app_utilisateur_new')]
    public function new(Request $request, UtilisateurRepository $utilisateurRepository, UserPasswordEncoderInterface $encoder)
    {
        $ut = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $ut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash=$encoder->encodePassword($ut, $ut->getPasswuser());
            $ut->setPasswuser($hash);
            $utilisateurRepository->save($ut, true);

            return $this->redirectToRoute('nn');
        }



        return $this->renderForm('utilisateur/new.html.twig', [
            'utilisateur' => $ut,
            'form' => $form,
        ]);
    }
    #[Route('/{iduser}/ajoutd', name: 'ajoutd')]
    public function Ajouter(Request $request,$iduser,UtilisateurRepository $repo)
    {
        //à partir de Request on va recuperer les informations de notre requette http

        //Creation d'un nouveau demandeur
        $demandeur = $repo->find($iduser);
        // faire l'appel à notre formulaire
        $form = $this->createForm(DemandeurType::class, $demandeur);
        //Recuperer des informations de la requette d'objet
        $form->handleRequest($request); // gerer les requettes + parcourir la requette et extraire les informations de la formulaire

        if ($form->isSubmitted() && $form->isValid()) {
            $demandeur->setRole("demandeur");
            $em = $this->getDoctrine()->getManager();
            $em->persist($demandeur);
            $em->flush();
            //Rederiction vers la page d'affichage

            return $this->redirectToRoute('app_utilisateur_index'); // nom de la fonction affiche
        }
        return $this->render('utilisateur/Ajoutd.html.twig',['form'=>$form->createView()]);
    }

    #[Route('/ajout/prestateur/{id}', name: 'ajoutper')]
    public function Ajouterp(Request $request,$id,UtilisateurRepository $repo)
    {
        //à partir de Request on va recuperer les informations de notre requette http

        //Creation d'un nouveau demandeur
        $prestateur = $repo->find($id);
        // faire l'appel à notre formulaire
        $form = $this->createForm(PrestateurType::class, $prestateur);
        //Recuperer des informations de la requette d'objet
        $form->handleRequest($request); // gerer les requettes + parcourir la requette et extraire les informations de la formulaire

        if ($form->isSubmitted() && $form->isValid()) {
            $prestateur->setRole("prestateur");
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestateur);
            $em->flush();
            //Rederiction vers la page d'affichage

            return $this->redirectToRoute('app_utilisateur_index'); // nom de la fonction affiche
        }
        return $this->render('utilisateur/Ajoutp.html.twig',['form'=>$form->createView()]);
    }


    #[Route('/cx', name: 'nn')]
    public function login2(MailerInterface $mailer,UtilisateurRepository $repo, Request $request, UserPasswordEncoderInterface $encoder){
        $donnees = $this->getDoctrine()->getRepository(Service::class)->findAll();
        $utilisateur=new Log();
        $form=$this->createForm(LogType::class, $utilisateur);
        $form->handleRequest($request);
        $ut=$repo->findByLogin($utilisateur->getLogin());
        $random = random_int(10000000,10000000000);
        $str = (string) $random;
        if ($form->isSubmitted()) {
            if($ut!=null) {
                $isPass = password_verify($utilisateur->getPassw(), $ut->getPasswuser());
                if ($utilisateur->getLogin() == $ut->getLoginuser() && $isPass === true) {
                    if($ut->getRole()=='bloquer'){
                        return $this->render('utilisateur/bloque.html.twig');

                    }else{
                        $ut->setVerify($str);
                        $repo->save($ut,true);

                        $sid = "ACda633fc1b6c821502df86b8c5e29ce95";
                        $token = "167f56216211940bc42cb47f08863591";
                        $twilio = new Client($sid, $token);
                        $message = $twilio->messages
                            ->create("+21620542959", // to
                                array(
                                    "from" => "+15627844569",
                                    "body" => "Ramcha.tn : Votre code de confirmation est ".$str
                                )
                            );

                        return $this->redirectToRoute('verify', ['id'=>$ut->getIduser()], Response::HTTP_SEE_OTHER);
                    }

                }
            }
        }
        return $this->renderForm('utilisateur/log.html.twig', ['form'=>$form, 'log'=>$utilisateur,'services' => $donnees]);
    }



    #[Route('/cnx', name: 'login')]
    public function login(){

        return $this->render('utilisateur/login.html.twig');
    }

    #[Route('/decnx', name: 'logout')]
    public function logout(){
        return $this->render('utilisateur/login.html.twig');
    }

    #[Route('/stat', name: 'stat')]
    public function Stat(){
        return $this->render('utilisateur/stat.html.twig');
    }

    #[Route('/Recher', name: 'recher')]
    public function Recherche(UtilisateurRepository $repo , Request $request){
        //1-nzid form + label f affiche

        // nekhou eli mawjoud f input (recuperer par la requette Request)
        $data=$request->get('search'); // eli mawjoud f name mtaa input
        $utilisateur=$repo->findBy(['nomuser'=>$data]); // l'attribut Name de la utilisateur va etre comparer avec la variable saisie dans l'input
        return $this->render('utilisateur/index.html.twig',['utilisateurs'=>$utilisateur]);
    }

    #[Route('/Recherp', name: 'recherp')]
    public function Recherchep(UtilisateurRepository $repo , Request $request){
        //1-nzid form + label f affiche

        // nekhou eli mawjoud f input (recuperer par la requette Request)
        $data=$request->get('search'); // eli mawjoud f name mtaa input
        $utilisateur=$repo->findBy(['dispop'=>$data]); // l'attribut Name de la utilisateur va etre comparer avec la variable saisie dans l'input
        return $this->render('utilisateur/Affichep.html.twig',['pres'=>$utilisateur]);
    }

    #[Route('/Recherd', name: 'recherd')]
    public function Recherched(UtilisateurRepository $repo , Request $request){
        //1-nzid form + label f affiche

        // nekhou eli mawjoud f input (recuperer par la requette Request)
        $data=$request->get('search'); // eli mawjoud f name mtaa input
        $utilisateur=$repo->findBy(['libelledemande'=>$data]); // l'attribut Name de la utilisateur va etre comparer avec la variable saisie dans l'input
        return $this->render('utilisateur/Affiched.html.twig',['dem'=>$utilisateur]);
    }


    #[Route('/', name: 'app_utilisateur_index')]
    public function index(UtilisateurRepository $utilisateurRepository, Request $req,PaginatorInterface $paginator)
    {

        $data=$utilisateurRepository->orderByName();
        $utilisateurs= $paginator->paginate(
            $data,
            $req->query->getInt('page', 1),
            3
        );
        $ut=$utilisateurRepository->NbUser();
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
            'ut'=>$ut[0][1]
        ]);

    }

    #[Route('/ind2', name: 'app_utilisateur_index2')]
    public function index2(UtilisateurRepository $utilisateurRepository, Request $req,PaginatorInterface $paginator)
    {

        $data=$utilisateurRepository->orderByNamedes();

        $utilisateurs= $paginator->paginate(
            $data,
            $req->query->getInt('page', 1),
            3
        );
        $ut=$utilisateurRepository->NbUser();
        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
            'ut'=>$ut[0][1]
        ]);

    }

    #[Route('/aff', name: 'app_utilisateur_showf')]
    public function Affiche(UtilisateurRepository $repo, Request $req,PaginatorInterface $paginator )
    {

        $utilisateurs=$repo->orderByName();
        $data =$repo->showByRoleD();
        $utilisateurs= $paginator->paginate(
            $data,
            $req->query->getInt('page', 1),
            1
        );
        $ut=$repo->NbDem();
        // recuperer le Repository
        //recuperer l'objet classroom via le repository

        //envoyer à la vue pour gerer l'affichage en tableau
        return $this->render('utilisateur/Affiched.html.twig', ['dem'=>$utilisateurs , 'ut'=>$ut[0][1]]);
    }

    #[Route('/affp', name: 'app_utilisateur_showp')]
    public function Affichep(UtilisateurRepository $repo,  Request $req,PaginatorInterface $paginator )
    {

        $data =$repo->showByRoleP();
        $utilisateurs= $paginator->paginate(
            $data,
            $req->query->getInt('page', 1),
            1
        );
        $ut=$repo->NbPrest();
        // recuperer le Repository
        //recuperer l'objet classroom via le repository

        //envoyer à la vue pour gerer l'affichage en tableau
        return $this->render('utilisateur/Affichep.html.twig', ['pres'=>$utilisateurs, 'ut'=>$ut[0][1]]);
    }




    #[Route('/{iduser}/delp', name: 'app_utilisateur_deletep')]

    public function deletep(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getIduser(), $request->request->get('_token'))) {
            $utilisateurRepository->remove($utilisateur, true);
        }

        return $this->redirectToRoute('app_utilisateur_showp');
    }

    #[Route('/{iduser}/editp', name: 'app_utilisateur_editp')]
    public function modifierp(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {
        $form = $this->createForm(PrestateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurRepository->save($utilisateur, true);

            return $this->redirectToRoute('app_utilisateur_showp');
        }

        return $this->renderForm('utilisateur/Modifierp.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }
    #[Route('/{iduser}/deld', name: 'app_utilisateur_deleted')]
    public function deleted(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getIduser(), $request->request->get('_token'))) {
            $utilisateurRepository->remove($utilisateur, true);
        }

        return $this->redirectToRoute('app_utilisateur_showf', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{iduser}/editd', name: 'app_utilisateur_editd')]
    public function modifierd(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {
        $form = $this->createForm(DemandeurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurRepository->save($utilisateur, true);

            return $this->redirectToRoute('app_utilisateur_showf');
        }

        return $this->renderForm('utilisateur/Modifierd.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }


    #[Route('/{iduser}/shp', name: 'showp')]
    public function showp(Utilisateur $utilisateur)
    {


        return $this->render('utilisateur/showp.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{iduser}/shd', name: 'showd')]
    public function showd(Utilisateur $utilisateur)
    {
        return $this->render('utilisateur/showd.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{iduser}/edit', name: 'app_utilisateur_edit')]
    public function edit(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {
        $form = $this->createForm(UtilType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurRepository->save($utilisateur, true);

            return $this->redirectToRoute('app_utilisateur_index');
        }
        return $this->renderForm('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/reset', name: 'mdpreset')]
    public function reset(UtilisateurRepository $repo, Request $req){
        $utilisateur=new Log();
        $form=$this->createForm(ResetType::class, $utilisateur);
        $form->handleRequest($req);
        if ($form->getClickedButton() === $form->get('save')){
            $ut=$repo->findByLogin($utilisateur->getLogin());
            if($ut!=null){
                return $this->redirectToRoute('mailling', ['id'=>$ut->getIduser()], Response::HTTP_SEE_OTHER);
            }
        }

        /*if ($form->getClickedButton() === $form->get('saveAndAdd')){
            $ut=$repo->findByLogin($utilisateur->getLogin());
            if($ut!=null){
                return $this->redirectToRoute('msg', ['id'=>$ut->getIduser()], Response::HTTP_SEE_OTHER);
            }
        }*/

        return $this->renderForm('utilisateur/resetpwd.html.twig', ['form'=>$form, 'log'=>$utilisateur]);
    }

    #[Route('/verify/{id}', name: 'verify')]
    public function verify(UtilisateurRepository $repo, Request $request, $id){
        $session = $this->container->get('session');
        $ut=$repo->find($id);
        $tt = new Utilisateur();
        $form = $this->createForm(VerifyType::class,$tt);
        $form->handleRequest($request);
        $session->set('user',$ut);
        if ($form->isSubmitted()) {
            if ($ut != null) {
                if($tt->getVerify() == $ut->getVerify())
                    if ($ut->getRole() == "admin") {
                        return $this->redirectToRoute('DASH', [], Response::HTTP_SEE_OTHER);
                    } else {
                        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);

                    }

            }
        }

        return $this->renderForm('utilisateur/verify.html.twig', ['form'=>$form, 'tt'=>$tt,'num'=>$ut->getNumuser()]);

    }




    #[Route('/msg/{id}',name: 'msg')]
    public function sendmsg(Utilisateur $user, UtilisateurRepository $repo,UserPasswordEncoderInterface $encoder)
    {
        $random = random_int(10000000,10000000000);
        $str = (string) $random;
        $sid    = "ACda633fc1b6c821502df86b8c5e29ce95";
        $token  = "7c0ba313acefb52845a986f24733fa5c";
        $twilio = new Client($sid, $token);
        $message = $twilio->messages
            ->create("+21620542959", // to
                array(
                    "from" => "+15627844569",
                    "body" => "Ramcha.tn : Votre code de confirmation est ".$str
                )
            );


        /*$user->setPasswuser($random);
        $hash=$encoder->encodePassword($user, $user->getPasswuser());
        $user->setPasswuser($hash);
        $repo->save($user, true);*/


        return $this->render('utilisateur/verify.html.twig');
    }


    #[Route('/email/{id}',name: 'mailling')]
    public function sendEmail(MailerInterface $mailer,Utilisateur $user, UtilisateurRepository $repo,UserPasswordEncoderInterface $encoder): Response
    {
        $random = random_int(10000000,10000000000);
        $str = (string) $random;
        $html = $this->renderView('utilisateur/zin.html.twig',[
            'str'=>$str,
            'email'=>$user->getLoginuser(),
            'username'=>$user->getNomuser(),
        ]);
        //dd($random);
        //$string = $user->getNomuser().$user->getPrenomuser();
        $email = (new TemplatedEmail())
            ->from('Ramcha@gmail.com')
            ->to($user->getLoginuser())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Recupération du mot de passe')
            //->text('Votre nouveau mot de passe est')
            // path of the Twig template to render
            ->html($html)

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
            ]);

        $mailer->send($email);
        $user->setPasswuser($random);
        $hash=$encoder->encodePassword($user, $user->getPasswuser());
        $user->setPasswuser($hash);
        $repo->save($user, true);


        // ...

        return $this->render('/utilisateur/mail.html.twig');
    }

    #[Route('/veremail/{id}',name: 'veremail')]
    public function sendEmailVerif(MailerInterface $mailer,Utilisateur $user, UtilisateurRepository $repo,UserPasswordEncoderInterface $encoder): Response
    {
        $random = random_int(10000000,10000000000);
        $str = (string) $random;
        $html = $this->renderView('utilisateur/zinverif.html.twig',[
            'str'=>$str,
            'email'=>$user->getLoginuser(),
            'username'=>$user->getNomuser(),
        ]);
        //dd($random);
        //$string = $user->getNomuser().$user->getPrenomuser();
        $email = (new TemplatedEmail())
            ->from('Ramcha@gmail.com')
            ->to($user->getLoginuser())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Code de confirmation')
            //->text('Votre nouveau mot de passe est')
            // path of the Twig template to render
            ->html($html)

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
            ]);

        $mailer->send($email);
        /*$user->setPasswuser($random);
        $hash=$encoder->encodePassword($user, $user->getPasswuser());
        $user->setPasswuser($hash);
        $repo->save($user, true);*/


        // ...

        return $this->render('utilisateur/verify.html.twig');
    }


    #[Route ('/ser', name: 'app_ser')]
    public function searchStudentx(Request $request,NormalizerInterface $Normalizer, UtilisateurRepository $repo)
    {

        $requestString=$request->get('searchValue');
        $utilisateur = $repo->findByMultiple($requestString);
        $jsonContent = $Normalizer->normalize($utilisateur, 'json',['groups'=>'utilisateurs:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);
    }

    /*
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }


    #[Route('/change_langue', name: 'change_langue')]
    public function ok(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }*/


    /*
        #[Route('/changeLocale', name: 'changeLocale')]
        public function changeLocale(RequestStack $requestStack, Request $request, EntityManagerInterface $em)
        {

            $langue = $request->request->get('langue');
            $user = $this->getUser();
            if($user)
            {
                $user->setLocale($langue);
                $em->persist($user);
                $em->flush();
            }
            $requestStack->getSession()->set('_locale', $langue);
            return new Response("ok");

        }


    */
    #[Route('/{iduser}/bloque', name: 'app_utilisateur_bloque')]
    public function bloque(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {

        $utilisateur->setRole('bloquer');
        //$utilisateurRepository->save($utilisateur, true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($utilisateur);
        $em->flush();
        $utilisateurRepository->save($utilisateur, true);
        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);



    }

    #[Route('/{iduser}/debloque', name: 'app_utilisateur_debloque')]
    public function debbloque(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository)
    {

        $utilisateur->setRole('user');
        //$utilisateurRepository->save($utilisateur, true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($utilisateur);
        $em->flush();
        $utilisateurRepository->save($utilisateur, true);
        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);



    }

    #[Route('/affb', name: 'app_utilisateur_showb')]
    public function Afficheb(UtilisateurRepository $repo,  Request $req,PaginatorInterface $paginator )
    {

        $data =$repo->showByRoleB();
        $utilisateurs= $paginator->paginate(
            $data,
            $req->query->getInt('page', 1),
            1
        );
        $ut=$repo->NbBloc();
        // recuperer le Repository
        //recuperer l'objet classroom via le repository

        //envoyer à la vue pour gerer l'affichage en tableau
        return $this->render('utilisateur/Afficheb.html.twig', ['utilisateurs'=>$utilisateurs, 'ut'=>$ut[0][1]]);
    }
    #[Route('/dash', name:'DASH')]
    public function aaaa(CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository)
    {
        return $this->render('Admin.html.twig');
    }

    #[Route('/ramcha', name:'ramcha')]
    public function bbbb(CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository)
    {
        $donnees = $this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('Admin.html.twig', ['services' => $donnees]);
    }

    #[Route('/home', name:'home')]
    public function bbbbb(CommandearticleArticleUtilisateurRepository $commandearticleArticleUtilisateurRepository, CommandeserviceServiceUtilisateurRepository $commandeserviceServiceUtilisateurRepository)
    {
        $donnees = $this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('fr.html.twig', ['services' => $donnees]);
    }

}
