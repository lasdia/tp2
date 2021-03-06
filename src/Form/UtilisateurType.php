<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('roles', ChoiceType::class,[
                'choices'=> [
                    'Utilisateur normal' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Modérateur' => 'ROLE_MODO',
                    'écrivain' => 'ROLE_ECRIVAIN',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
