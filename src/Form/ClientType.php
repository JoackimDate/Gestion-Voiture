<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('prenom',TextType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('telephone',NumberType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('nom_utilisateur',TextType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('mot_de_passe',NumberType::class , [ "attr" => ["class" => "form-control"] ])
            ->add('cni',TextType::class , [ "attr" => ["class" => "form-control"] ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
