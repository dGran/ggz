<?php

namespace App\Controller\Customer\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnboardingController extends AbstractController
{
    #[Route('/onboarding/step-one', name: 'customer_onboarding_step_one')]
    public function stepOne(): Response
    {
        return $this->render('customer/auth/signup/onboarding/step_one.html.twig');
    }

    #[Route('/onboarding/step-two', name: 'customer_onboarding_step_two')]
    public function stepTwo(): Response
    {
        return $this->render('customer/auth/signup/onboarding/step_two.html.twig');
    }

    #[Route('/onboarding/step-three', name: 'customer_onboarding_step_three')]
    public function stepThree(): Response
    {
        return $this->render('customer/auth/signup/onboarding/step_three.html.twig');
    }
}
