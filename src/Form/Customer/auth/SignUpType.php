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
                    'class' => 'w-full text-white py-2.5 px-4 font-ubuntu bg-[#B063FD] border-0 border-b border-[#c5b7d4] focus:border-white hover:border-white focus:bg-[#bc7cfd] rounded-t-md focus:outline-none focus:ring-0 ring-white placeholder-gray-300',
                    'id' => 'input-email',
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Password',
                    'class' => 'w-full text-white py-2.5 px-4 font-ubuntu bg-[#B063FD] border-0 border-b border-[#c5b7d4] focus:border-white hover:border-white focus:bg-[#bc7cfd] rounded-t-md focus:outline-none focus:ring-0 ring-white placeholder-gray-300',
                    'autocomplete' => 'new-password',
                    'id' => 'input-password',
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
                    'class' => 'my-5 w-full font-bold bg-[#CCCC] hover:bg-[#DDD] focus:bg-[#DDD] focus:outline-none focus:ring-0 font-bold font-ubuntu rounded-md py-2.5 text-center shadow-md shadow-[#6700BC]',
                    'id' => 'button-send-form',
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
