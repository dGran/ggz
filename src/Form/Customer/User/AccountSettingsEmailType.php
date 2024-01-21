<?php

declare(strict_types=1);

namespace App\Form\Customer\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountSettingsEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'label_attr' => [
                    'class' => 'font-lato font-medium text-md text-disabled-gray',
                ],
                'attr' => [
                    'placeholder' => 'E-mail address',
                    'class' => 'w-[22rem] text-black py-2.5 px-4 resize-none font-ubuntu bg-gray-50 border-b-2 border-gray-200 rounded-t-md mt-1 bg-opacity-25 focus:outline-none focus:ring-2 focus:ring-purpleggz2 focus:bg-[#FAF5FE]',
                    'disabled' => true,
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Edit',
                'attr' => [
                    'class' => 'font-lato text-purpleggz2 ml-4 hover:text-purpleggz',
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
