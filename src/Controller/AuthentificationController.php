<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/authentification", name="authentification")
     */
    public function index(Request $request,PersonneRepository $personneRepository,RequestStack $requestStack ): Response
    {
        if($request->request->get('username')!=null ){
            $username= $request->request->get('username');
            $password= $request->request->get('password');
            $personne=new Personne();
            $personne=$personneRepository->findOneBy([
                'nomUtilisateur'=>$username,
                'motDePasse'=>$password
            ]);
            if($personne!=null && $personne->getId()>0){
                $session = $requestStack->getSession();
                $session->set('nom', $personne->getNom());
                $session->set('prenom', $personne->getPrenom());
                $session->set('nomUtilisateur', $personne->getNomUtilisateur());
                //$foo = $session->get('foo'); 

                // the second argument is the value returned when the attribute doesn't exist
                //$filters = $session->get('filters', []);
                return $this->redirectToRoute('tableau_de_bord');
            }

        }
        return $this->render('authentification/index.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */

    public function seDeconnecter(RequestStack $requestStack)
    {
        $session = $requestStack->getSession();
        $session->set('nom', null);
        $session->set('prenom', null);
        $session->set('nomUtilisateur', null);
        return $this->redirectToRoute('tableau_de_bord');
    }
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordHasher): Response
    {
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword(
                $personne,
                $personne->getPassword()
            );
            // $personne->setRoleLibelle("client");
            $personne->setPassword($hashedPassword);
            $entityManager->persist($personne);
            $entityManager->flush();

            return $this->redirectToRoute('authentification');
        }

        return $this->renderForm('authentification/inscription.html.twig', [
            'personne' => $personne,
            'form' => $form,
        ]);
    }

}
