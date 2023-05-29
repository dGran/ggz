<?php

namespace App\Controller\Customer\Authentication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnboardingController extends AbstractController
{
    #[Route('/onboarding/step-one', name: 'app_onboarding_step_one')]
    public function stepOne(): Response
    {
        return $this->render('customer/authentication/onboarding/step_one.html.twig');
    }

    #[Route('/onboarding/step-two', name: 'app_onboarding_step_two')]
    public function stepTwo(): Response
    {
        return $this->render('customer/authentication/onboarding/step_two.html.twig');
    }

    #[Route('/onboarding/step-three', name: 'app_onboarding_step_three')]
    public function stepThree(): Response
    {
        return $this->render('customer/authentication/onboarding/step_three.html.twig');
    }
}
