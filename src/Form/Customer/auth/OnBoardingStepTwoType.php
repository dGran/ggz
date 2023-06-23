<?php

declare(strict_types=1);

namespace App\Form\Customer\auth;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OnBoardingStepTwoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('birthdate', DateTimeType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Choose a username',
                    'class' => 'black-placeholder text-whiteblock p-2.5 pl-4 resize-none font-ubuntu text-blacktext bg-[#F2EDF6] border-b-2 border-[#303030] rounded-t-md focus:ring-blue-500 focus:border-blue-500 mt-6 mb-2',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'GO TO NEXT STEP',
                'attr' => [
                    'class' => 'mt-2 text-[#878787] bg-[#CCCCCC] focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-bold font-ubuntu rounded-lg text-2xl py-2.5 text-center inline-flex mx-auto px-6 dark:focus:ring-[#4285F4]/55 mb-2',
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
