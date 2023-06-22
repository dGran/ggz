<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
    #[Security('is_granted("ROLE_USER")')]
    public function onBoardingStepOne(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('customer/user/onboarding/step_one.html.twig',
            [
                'user' => $user,
            ]
        );
    }

    #[Route('/onboarding/{user}/step-two', name: 'customer_onboarding_step_two')]
    #[Security('is_granted("ROLE_USER")')]
    public function onBoardingStepTwo(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('customer/user/onboarding/step_two.html.twig');
    }

    #[Route('/onboarding/{user}/step-three', name: 'customer_onboarding_step_three')]
    #[Security('is_granted("ROLE_USER")')]
    public function onBoardingStepThree(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('customer/user/onboarding/step_three.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
