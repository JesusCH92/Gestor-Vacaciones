<?php

namespace App\User\Infrastructure\Framework\Form;

use App\Entity\Company;
use App\Entity\Department;
use App\User\Infrastructure\Framework\Form\Model\RegistrationFormModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('lastname', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('plainPassword', PasswordType::class, [
                // 'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('department', EntityType::class, [
                'class' => Department::class,
            ])
            ->add('company', EntityType::class, [
                'class' => Company::class,
            ])
            ->add('roles', ChoiceType::class, [
                'choices'  => ['Admin' => 'ROLE_ADMIN', 'user' => 'ROLE_USER', 'supervisor' => 'ROLE_SUPERVISOR'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegistrationFormModel::class,
        ]);
    }
}
