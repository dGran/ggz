<?php

declare(strict_types=1);

namespace App\Form\Customer\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
                    'class' => 'hidden',
                    'accept' => 'image/jpeg, image/jpg, image/png, image/tiff, image/webp',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '40M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Please upload an image in JPEG, JPG, PNG, TIFF or WEBP format and not exceeding 40 MB.',
                    ]),
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
                    'class' => 'w-full py-2.5 px-4 font-ubuntu bg-[#F2EDF6] border-0 border-b-2 border-[#6C5D73] focus:bg-white focus:border-purpleggz hover:border-purpleggz rounded-t-md placeholder-gray-500 focus:outline-none focus:ring-0',
                ],
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'COMPLETE REGISTRATION',
                'attr' => [
                    'class' => 'w-full text-white text-base md:text-lg font-ubuntu py-2.5 px-4 font-extrabold bg-[#7D00E2] hover:bg-[#6B00C1] focus:bg-[#6B00C1] font-bold rounded-md focus:outline-none',
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
