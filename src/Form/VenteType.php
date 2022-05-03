<?php

namespace App\Form;

use App\Entity\Vente;
use App\Entity\Voiture;
use App\Entity\Client;
use App\Repository\VoitureRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class VenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_vente',DateType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('montant',NumberType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('voiture',EntityType::class,[
                'class' => Voiture::class,
                'choice_label' => 'numeroSerie',
            //     'query_builder' =>function (VoitureRepository $voitureRepository) {
            //     return $voitureRepository->createQueryBuilder('v')
            //     ->andWhere('v.dejaVendue = :val')
            //     ->setParameter('val', false);
            // },
            ])
            ->add('client',EntityType::class,[
                'class' => Client::class,
                'choice_label' => 'nom',
             
            ])
        ;   
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vente::class,
        ]);
    }
}
