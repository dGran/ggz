<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use App\Form\Customer\auth\OnBoardingStepOneType;
use App\Form\Customer\auth\OnBoardingStepTwoType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class OnBoardingController extends AbstractController
{
    private AuthorizationCheckerInterface $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    #[Route('/onboarding/{user}/step-one', name: 'customer_onboarding_step_one')]
    #[Security('is_granted("ROLE_USER")')]
    public function onBoardingStepOne(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($user->isOnBoardingComplete()) {
            return $this->redirectToRoute('customer_profile', ['user' => $user->getId()]);
        }

        $form = $this->createForm(OnBoardingStepOneType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {;

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('customer_onboarding_step_two', ['user' => $user->getId()]);
        }

        return $this->render('customer/user/onboarding/step_one.html.twig',
            [
                'user' => $user,
                'on_boarding_step_one_form' => $form->createView(),
            ]
        );
    }

    #[Route('/onboarding/{user}/step-two', name: 'customer_onboarding_step_two')]
    #[Security('is_granted("ROLE_USER")')]
    public function onBoardingStepTwo(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($user->isOnBoardingComplete()) {
            return $this->redirectToRoute('customer_profile', ['user' => $user->getId()]);
        }

        $form = $this->createForm(OnBoardingStepTwoType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {;

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('customer_onboarding_step_three', ['user' => $user->getId()]);
        }

        return $this->render('customer/user/onboarding/step_two.html.twig',
            [
                'user' => $user,
                'on_boarding_step_two_form' => $form->createView(),
            ]
        );
    }

    #[Route('/onboarding/{user}/step-three', name: 'customer_onboarding_step_three')]
    #[Security('is_granted("ROLE_USER")')]
    public function onBoardingStepThree(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($user->isOnBoardingComplete()) {
            return $this->redirectToRoute('customer_profile', ['user' => $user->getId()]);
        }

        return $this->render('customer/user/onboarding/step_three.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
