<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use App\Form\Customer\auth\OnBoardingStepOneType;
use App\Form\Customer\auth\OnBoardingStepThreeType;
use App\Form\Customer\auth\OnBoardingStepTwoType;
use App\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnBoardingController extends AbstractController
{
    public const STEP_ONE_NAME = 'one';
    public const STEP_TWO_NAME = 'two';
    public const STEP_THREE_NAME = 'three';

    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    #[Route('/onboarding/step/{step}', name: 'customer_onboarding', requirements: ['step' => 'one|two|three'])]
    #[Security('is_granted("ROLE_USER")')]
    public function onBoarding(Request $request, string $step): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isOnBoardingComplete()) {
            return $this->redirectToRoute('customer_user_profile');
        }

        $formType = match ($step) {
            self::STEP_ONE_NAME => OnBoardingStepOneType::class,
            self::STEP_TWO_NAME => OnBoardingStepTwoType::class,
            self::STEP_THREE_NAME => OnBoardingStepThreeType::class,
            default => throw new \InvalidArgumentException('Invalid onboarding step.'),
        };

        $form = $this->createForm($formType, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (($step === 'one') && !$this->isValidNickname($form->get('nickname')->getData())) {
                return $this->redirectToRoute('customer_onboarding', ['step' => $step]);
            }

            $user->setDateUpdated(new \DateTime());
            $this->userManager->save($user);

            if ($step === 'three') {
                /** @var UploadedFile $profilePicFile */
                $profilePicFile = $form['profilePic']->getData();

                if ($profilePicFile) {
                    $destination = $this->getParameter('kernel.project_dir') . '/public/' . User::PROFILE_PIC_PATH;
                    $filename = uniqid('', true) . '.' . $profilePicFile->guessExtension();
                    $profilePicFile->move($destination, $filename);
                    $user->setProfilePic($filename);
                }

                $user->setOnBoardingComplete(true);
                $this->userManager->save($user);

                return $this->redirectToRoute('customer_user_profile');
            }

            $nextStep = $step === self::STEP_ONE_NAME ? self::STEP_TWO_NAME : self::STEP_THREE_NAME;

            return $this->redirectToRoute('customer_onboarding', ['step' => $nextStep]);
        }

        $template = 'customer/user/onboarding/step_' . $step . '.html.twig';

        return $this->render($template, [
            'user' => $user,
            'on_boarding_step_' . $step . '_form' => $form->createView(),
        ]);
    }

    #[Route('/onboarding/skip', name: 'customer_skip_onboarding')]
    #[Security('is_granted("ROLE_USER")')]
    public function skipOnBoarding(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $user->setOnBoardingComplete(true);
        $user->setDateUpdated(new \DateTime());

        $this->userManager->save($user);

        return $this->redirectToRoute('customer_user_profile');
    }

    private function isValidNickname(string $nickname = null): bool
    {
        if ($nickname === null) {
            return false;
        }

        if (strlen($nickname) < 4 || strlen($nickname) > 24) {
            return false;
        }

        $user = $this->userManager->findByNickname($nickname);

        if ($user) {
            return false;
        }

        return true;
    }
}
