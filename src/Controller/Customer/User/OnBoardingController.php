<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function onBoardingStepOne(User $user): Response
    {
//        dump($user);die;


//        if (
//            !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
//            || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
//        ) {
//            return $this->redirectToRoute('customer_home');
//        }

        return $this->render('customer/user/onboarding/step_one.html.twig',
            [
                'user' => $user,
            ]
        );
    }

    #[Route('/onboarding/{user}/step-two', name: 'customer_onboarding_step_two')]
    public function onBoardingStepTwo(User $user): Response
    {
        if (
            !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
            || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            return $this->redirectToRoute('customer_home',
                [
                    'user' => $user,
                ]
            );
        }

        return $this->render('customer/user/onboarding/step_two.html.twig');
    }

    #[Route('/onboarding/{user}/step-three', name: 'customer_onboarding_step_three')]
    public function onBoardingStepThree(User $user): Response
    {
        if (
            !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
            || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            return $this->redirectToRoute('customer_home');
        }

        return $this->render('customer/user/onboarding/step_three.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
