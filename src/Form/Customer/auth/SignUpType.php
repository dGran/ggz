<?php

namespace App\Form\Customer\auth;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'E-Mail',
                'attr' => [
                    'placeholder' => 'E-mail address',
                    'class' => 'white-placeholder text-whiteblock p-2.5 pl-4 resize-none font-ubuntu text-white bg-gray-50 border-b-2 border-white rounded-t-md focus:ring-blue-500 focus:border-blue-500 mt-6 mb-2 bg-opacity-25',
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Password',
                'attr' => [
                    'placeholder' => 'Password',
                    'class' => 'white-placeholder text-whiteblock p-2.5 pl-4 resize-none font-ubuntu text-white bg-gray-50 border-b-2 border-white rounded-t-md focus:ring-blue-500 focus:border-blue-500 mt-6 mb-2 bg-opacity-25',
                    'autocomplete' => 'new-password',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Choose your password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
