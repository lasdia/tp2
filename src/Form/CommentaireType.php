<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', TextType::class,[
                'label' => 'contenu'
            ])
            ->add('datePublication', DateType::class,[
                'label' => 'date'
            ])
            ->add('article', EntityType::class,[
                'class'=> Article::class,
                'choice_label'=> 'article',
                'required' => false
            ])
            ->add('utilisateur', EntityType::class,[
                'class'=> Utilisateur::class,
                'choice_label'=> 'pseudo',
                'required' => false
             
            ])
            
            ->add('submit', SubmitType::class,[
                'label'=> 'Envoyer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
