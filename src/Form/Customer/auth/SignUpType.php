<?php

declare(strict_types=1);

namespace App\Form\Customer\auth;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'E-mail address',
                    'class' => 'white-placeholder text-whiteblock p-2.5 pl-4 resize-none font-ubuntu text-white bg-gray-50 border-b-2 border-white rounded-t-md focus:ring-blue-500 focus:border-blue-500 mt-6 mb-2 bg-opacity-25',
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Password',
                    'class' => 'white-placeholder text-whiteblock p-2.5 pl-4 resize-none font-ubuntu text-white bg-gray-50 border-b-2 border-white rounded-t-md focus:ring-blue-500 focus:border-blue-500 bg-opacity-25',
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
            ->add('submit', SubmitType::class, [
                'label' => 'Proceed with your e-mail',
                'attr' => [
                    'class' => 'w-full py-2.5 px-4 text-[#878787] bg-[#CCCCCC] focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium font-ubuntu rounded-lg text-md text-center inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mb-2',
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
