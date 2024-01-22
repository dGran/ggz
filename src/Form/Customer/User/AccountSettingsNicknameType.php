<?php

declare(strict_types=1);

namespace App\Form\Customer\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class AccountSettingsNicknameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname', TextType::class, [
                'label' => 'Nickname',
                'label_attr' => [
                    'class' => 'font-lato font-medium text-md text-disabled-gray',
                ],
                'attr' => [
                    'placeholder' => 'Choose a username',
                    'class' => 'w-[22rem] text-black py-2.5 px-4 resize-none font-ubuntu bg-gray-50 border-b-2 border-gray-200 rounded-t-md mt-1 bg-opacity-25 focus:outline-none focus:ring-2 focus:ring-purpleggz2 focus:bg-[#FAF5FE]',
                    'disabled' => true,
                ],
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 24,
                        'minMessage' => 'Nickname must be at least {{ limit }} characters long',
                        'maxMessage' => 'Nickname cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Edit',
                'attr' => [
                    'class' => 'font-lato text-purpleggz2 ml-4 hover:text-purpleggz focus:text-purpleggz focus:outline-none',
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
