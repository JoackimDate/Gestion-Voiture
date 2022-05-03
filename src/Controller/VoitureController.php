<?php

namespace App\Controller;

use App\Entity\Voiture;

use App\Form\Voiture1Type;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voiture")
 */
class VoitureController extends AbstractController
{
    /**
     * @Route("/list", name="app_voiture_index")
     */
    public function index(VoitureRepository $voitureRepository): Response
    {
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitureRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/new", name="app_voiture_new")
     */
    public function new(Request $request, VoitureRepository $voitureRepository): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(Voiture1Type::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voitureRepository->add($voiture);
            return $this->redirectToRoute('app_voiture_index');
        }

        return $this->renderForm('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_voiture_edit")
     */
    public function edit(Request $request, Voiture $voiture, VoitureRepository $voitureRepository): Response
    {
        $form = $this->createForm(Voiture1Type::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voitureRepository->add($voiture);
            return $this->redirectToRoute('app_voiture_index');
        }

        return $this->renderForm('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_voiture_delete")
     */
    public function deleteVoiture( Voiture $voiture)
   {
      
          $em = $this->getDoctrine()->getManager();

          $em ->remove($voiture);
          $em ->flush();

          return $this->redirectToRoute('app_voiture_index');

       
   }
}
