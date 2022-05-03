<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()!=null){
            return $this->redirectToRoute('tableau_de_bord');
        }
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username'   =>$lastUsername,
            'error'         => $error,
        ]);
    }
     /**
     * @Route("/inscription", name="app_inscription")
     */
    public function creerCompte(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $personne = new personne();
        $form=$this->createForm(PersonneType::class, $personne);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hasdePassword= $passwordHasher->hashPassword($personne, $personne->getPassword());
            $personne->setPassword($hasdePassword);
            $em ->persist($personne);
            // $personne -> setRoles(["ROLE_ADMIN"]);
            // $personne -> setCreePar(1);
            // $personne -> setCreerLe(new \Datetime('@'.strtotime('now')));
            $em ->flush();
            return $this->redirectToRoute('authentification');
  
        }
        return $this->render('login/inscription.html.twig',array(
            'form'=>$form->createView(), 

        ));
    }
}
