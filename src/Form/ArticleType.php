<?php

namespace App\Form;


use App\Entity\Article;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,[
                'label'=> 'titre'
            ])
            ->add('contenu',TextType::class,[
                'label' => 'contenu'
            ])
            ->add('image', TextType::class,[
                'label' => 'url image'
            ])
            ->add('datePublication', DateType::class,[
                'label' => 'date'
            ])
            ->add('utilisateur', EntityType::class,[
                'class'=> Utilisateur::class,
                'choice_label'=> 'pseudo'
            ])
            ->add('submit', SubmitType::class,[
                'label'=> 'Envoyer'
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
