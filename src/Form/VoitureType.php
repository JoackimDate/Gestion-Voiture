<?php

namespace App\Form;


use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque',TextType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('modele',TextType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('numero_identifiant',IntegerType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('numero_serie',NumberType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('date_achat',DateType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('couleur',TextType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('vente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
