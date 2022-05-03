<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VenteRepository;
use App\Entity\Vente;
use App\Form\VenteType;

/**
 * @Route("/vente")
 */
class VenteController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('vente/index.html.twig', [
            'controller_name' => 'VenteController',
        ]);
    }

    /**
     * @Route("/vente/ajout_vente", name="app_ajout_vente")
     */
    public function ajout_vente(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $vente = new vente();
        $form = $this->createForm(VenteType::class, $vente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vente);
            // $voitureVendue=$form->getData()->getVoiture();
            // $voitureVendue->setDejaVendue(true);
            $entityManager->flush();
            return $this->redirectToRoute('app_list_vente');
        }

        return $this->renderForm('vente/ajout_vente.html.twig', [
            'vente' => $vente,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/vente/list_vente", name="app_list_vente")
     */
    public function list_client(VenteRepository $venteRepository) {
        $vente = $venteRepository->findAll();
        return $this->render('vente/list_vente.html.twig', array(
            'ventes' =>$vente,
        ));
    }

    /**
     * @Route("/vente/{id}/modifier", name="app_modifier_vente")
     */
    public function modifier_vente(Request $request, Vente $vente, VenteRepository $venteRepository): Response
    {
        $form = $this->createForm(VenteType::class, $vente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $venteRepository->add($vente);
            return $this->redirectToRoute('app_list_vente');
        }

        return $this->renderForm('vente/modifier_vente.html.twig', [
            'vente' => $vente,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer_vente/{id}", name="app_supprimer_vente")
     */
    public function supprimer_vente( Vente $vente,EntityManagerInterface $entityManager): Response
    {
        $entityManager ->remove($vente);
        $entityManager ->flush();

        return $this->redirectToRoute('app_list_vente');

    }
   /**
     * @Route("/vente/{id}", name="app_afficher_vente")
     */
    public function afficher_vente(VenteRepository $venteRepository, $id): Response
    {
        $vente=$venteRepository->findOneBy(['id'=>$id]);
        return $this->render('vente/afficher_vente.html.twig', [
            'vente' => $vente,
        ]);
    }
}
