<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    /**
     * @Route("/client/ajout_client", name="app_client_ajout")
     */
    public function ajout_client(Request $Request,clientRepository $clientRepository, UserPasswordHasherInterface $passwordhash, EntityManagerInterface $entityManager){
        $client = new Client();
        $form = $this->createForm(clientType::class, $client);
        $form -> handleRequest($Request); 
        $personne=$this->getUser();
        $username=$personne->getUserIdentifier;
        if($form->isSubmitted() && $form->isValid()){
            $hashPassword=$passwordhash->hashPassword($client, $client->getPassword());
            $entityManager -> persist($client);
            $entityManager -> flush();

            $this->denyAccessUnlessGranted('ROLE_CLIENT', null, "Erreur d'acces 404");
            $client->setRoles(["ROLE_CLIENT"]);

            $this->addFlash(
                'notice',
                "Un nouveau Client à été ajoutée !!");

            return $this->redirectToRoute('app_list_client');

        }
        return $this->renderForm('client/ajout_client.html.twig',[
            'client' => $client,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/client/list_client", name="app_list_client")
     */
    public function list_client(ClientRepository $clientRepository) {
        $client = $clientRepository->findAll();
        return $this->render('client/list_client.html.twig', array(
            'clients' =>$client,
        ));
    }

    /**
     * @Route("/client/{id}/edit", name="app_modifier_client")
     */
    public function modifier_client(Request $request, Client $Client, EntityManagerInterface $entityManager ): Response
    {
        $form = $this->createForm(clientType::class, $Client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();

            return $this->redirectToRoute('list_client');
        }
        return $this->render('client/modifier_client.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/client/{id}", name="app_supprimer_client")
     */
    public function supprimer_client(Request $request, Client $client, EntityManagerInterface $entityManager): Response {
        $entityManager->flush();
        $entityManager -> remove($client);

        return $this->redirectToRoute('list_client');
    }

    /**
     * @Route("/client/{id}", name="app_afficher_client")
     */
    public function afficher_client(Client $client): Response
    {
        return $this->render('client/afficher_client.html.twig', [
            'client' => $client,
        ]);
    }

}
