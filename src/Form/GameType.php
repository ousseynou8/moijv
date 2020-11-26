<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('releaseDate', DateType::class, [
                'label' => 'Date de publication',
                'years' => range(1970, 2025)
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter le jeu'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
