<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ "name" avec un label "Title" (TextType pour du texte)
            ->add('name', TextType::class, [
                'label' => 'Title'
            ])
            // Champ "overview" (champ de texte) avec l'option "required" désactivée
            ->add('overview', null, [
                'required' => false
            ])
            // Champ "status" (choix multiple) avec des options de choix prédéfinies
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Cancelled' => 'cancelled',
                    'Ended' => 'ended',
                    'Returning' => 'returning'
                ],
                'multiple' => false // Permet de ne choisir qu'un seul élément
            ])
            // Les champs suivants n'ont pas de type spécifié, donc ils sont de type par défaut (probablement TextType)
            ->add('vote') // Champ "vote"
            ->add('popularity') // Champ "popularity"
            ->add('genres') // Champ "genres"
            ->add('firstAirDate', DateType::class, [
                'html5' => true, // Utilise l'élément HTML5 pour le champ de date
                'widget' => 'single_text' // Affiche un seul champ de texte pour la date
            ])
            ->add('lastAirDate', DateType::class) // Champ "lastAirDate" de type DateType
            ->add('backdrop') // Champ "backdrop"
            ->add('poster') // Champ "poster"
            ->add('tmdbID') // Champ "tmdbID"
            // Le champ 'submit' est commenté car il n'est pas nécessaire dans le formulaire (mauvaise pratique)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class, // L'entité associée au formulaire
        ]);
    }
}
