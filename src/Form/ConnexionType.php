<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\JsonType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles', ChoiceType::class, ['choices'=> [
                'UTILISATEUR'=> 'ROLE_USER',
                'ADMIN'=>'ROLE_SUPER_ADMIN'

            ]])
            ->add('password', PasswordType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('dateNaiss', BirthdayType::class)
            
            ->get('roles')
            ->addModelTransformer(new CallbackTransformer(function ($rolesAsArray) {
                    // transform the array to a string
                    return implode(', ', $rolesAsArray);
                },
                function ($rolesAsString) {
                    // transform the string back to an array
                    return explode(', ', $rolesAsString);
                }
            ))
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
