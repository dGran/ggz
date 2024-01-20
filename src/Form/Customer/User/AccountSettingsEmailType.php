<?php

declare(strict_types=1);

namespace App\Form\Customer\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountSettingsEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'E-mail address',
                    'class' => 'w-full text-white py-2.5 px-4 font-ubuntu bg-[#B063FD] border-0 border-b-2 border-[#c5b7d4] focus:border-white hover:border-white focus:bg-[#bc7cfd] rounded-t-md focus:outline-none focus:ring-0 ring-white placeholder-gray-300',
                    'disabled' => true,
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Edit',
                'attr' => [
                    'class' => 'font-lato text-purpleggz2 ml-4 hover:text-purpleggz edit',
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
