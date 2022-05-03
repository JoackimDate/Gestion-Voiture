<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use App\Repository\ClientRepository;
use App\Repository\VenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableauDeBordController extends AbstractController
{
    /** 
     *  @Route("/tableau_de_bord", name="app_tableau_de_bord")
     */
    public function allVoiture(VoitureRepository $voitureRepository,ClientRepository $clientRepository,VenteRepository $venteRepository,RequestStack $requestStack ): Response
    {
        $voitures=$voitureRepository->findAll();
        $clients=$clientRepository->findAll();
        $ventes=$venteRepository->findAll();

        $session = $requestStack->getSession();
        $username=$session->get('nomUtilisateur');
        $nom=$session->get('nom');
        $prenom=$session->get('prenom');
        // if ($username==null) {
        //     return $this->redirectToRoute("authentification");
        // }

        return $this->render('tableau_de_bord/index.html.twig', [
            'nombre_voiture' => count($voitures),
            'nombre_client' => count($clients),
            'nombre_vente' => count($ventes),
            'nom' => $nom,
            'prenom' => $prenom,
            'username' => $username,

        ]);
    }

    /** 
      * @Route("/Voiture",name="Voiture")
      */

    public function Voiture(VoitureRepository $voitureRepository )
    { 
        

      $numero = $_GET['marque'];
 


      return $this->render('tableau_de_bord/searchVoiture.html.twig',array(

        
        
      'voitures'=>$voitureRepository->searchVoiture($numero)));
    
    }

     /** 
      * @Route("/Client",name="Client")
      */

      public function Client(ClientRepository $clientRepository )
      { 
          
  
        $search = $_GET['cni'];
   
  
  
        return $this->render('tableau_de_bord/ClientSearch.html.twig',array(
  
          
          
        'clients'=>$clientRepository->ClientSearch($search)));
      
      }

   
}
