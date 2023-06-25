<?php

declare(strict_types=1);

namespace App\Form\Customer\auth;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OnBoardingStepTwoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('birthdate', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'placeholder' => 'Choose a username',
                    'class' => 'w-full py-2.5 px-4 font-ubuntu bg-[#F2EDF6] border-0 border-b-2 border-[#6C5D73] focus:bg-white focus:border-purpleggz hover:border-purpleggz rounded-t-md focus:outline-none focus:ring-0 ring-white placeholder-gray-500',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'GO TO FINAL STEP',
                'attr' => [
                    'class' => 'w-full font-ubuntu my-5 py-2.5 text-center text-lg font-extrabold focus:outline-none focus:ring-0 font-bold rounded-md',
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
