<?php

declare(strict_types=1);

namespace App\Form\Customer\auth;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OnBoardingStepThreeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('profilePic', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'black-placeholder text-whiteblock p-2.5 pl-4 resize-none font-ubuntu text-blacktext bg-[#F2EDF6] border-b-2 border-[#303030] rounded-t-md focus:ring-blue-500 focus:border-blue-500 mt-6 mb-2',
                ],
            ])
            ->add('shareContent', ChoiceType::class, [
                'choices' => [
                    User::SHARE_CONTENT_EVERYBODY => User::SHARE_CONTENT_EVERYBODY,
                    User::SHARE_CONTENT_FRIENDS_ONLY => User::SHARE_CONTENT_FRIENDS_ONLY,
                    User::SHARE_CONTENT_NOBODY => User::SHARE_CONTENT_NOBODY,
                ],
                'placeholder' => 'Share my content with',
                'label' => false,
                'attr' => [
                    'class' => 'black-placeholder text-whiteblock p-2.5 pl-4 text-xl font-ubuntu text-blacktext bg-[#F2EDF6] border-b-2 border-[#303030] rounded-t-md focus:ring-blue-500 focus:border-blue-500 mt-6 mb-2',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'COMPLETE REGISTRATION',
                'attr' => [
                    'class' => 'mt-12 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-bold font-ubuntu rounded-lg text-2xl py-2.5 text-center inline-flex mx-auto px-6 mb-2 disabled',
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
