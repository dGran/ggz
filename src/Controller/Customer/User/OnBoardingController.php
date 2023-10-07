<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use App\Form\Customer\auth\OnBoardingStepOneType;
use App\Form\Customer\auth\OnBoardingStepThreeType;
use App\Form\Customer\auth\OnBoardingStepTwoType;
use App\Manager\UserManager;
use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/onboarding')]
class OnBoardingController extends AbstractController
{
    private UserManager $userManager;

    private UserService $userService;

    public function __construct(UserManager $userManager, UserService $userService)
    {
        $this->userManager = $userManager;
        $this->userService = $userService;
    }

    #[Route('/step-one', name: 'customer_onboarding_step_one')]
    #[Security('is_granted("ROLE_USER")')]
    public function stepOne(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isOnBoardingComplete()) {
            return $this->redirectToRoute('customer_user_profile');
        }

        $formType = OnBoardingStepOneType::class;
        $form = $this->createForm($formType, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->userService->isValidNickname($form->get('nickname')->getData())) {
                return $this->redirectToRoute('customer_onboarding_step_one');
            }

            $this->userManager->update($user);

            return $this->redirectToRoute('customer_onboarding_step_two');
        }

        return $this->render('customer/user/onboarding/step_one.html.twig', [
            'user' => $user,
            'on_boarding_step_one_form' => $form->createView(),
        ]);
    }

    #[Route('/step-two', name: 'customer_onboarding_step_two')]
    #[Security('is_granted("ROLE_USER")')]
    public function stepTwo(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isOnBoardingComplete()) {
            return $this->redirectToRoute('customer_user_profile');
        }

        $formType = OnBoardingStepTwoType::class;
        $form = $this->createForm($formType, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userManager->update($user);

            return $this->redirectToRoute('customer_onboarding_step_three');
        }

        return $this->render('customer/user/onboarding/step_two.html.twig', [
            'user' => $user,
            'on_boarding_step_two_form' => $form->createView(),
        ]);
    }

    #[Route('/step-three', name: 'customer_onboarding_step_three')]
    #[Security('is_granted("ROLE_USER")')]
    public function stepThree(Request $request, string $step): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->isOnBoardingComplete()) {
            return $this->redirectToRoute('customer_user_profile');
        }

        $formType = OnBoardingStepThreeType::class;
        $form = $this->createForm($formType, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $profilePicFile */
            $profilePicFile = $form['profilePic']->getData();

            if ($profilePicFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/' . User::PROFILE_PIC_PATH;
                $filename = uniqid('', true) . '.' . $profilePicFile->guessExtension();
                $profilePicFile->move($destination, $filename);
                $user->setProfilePic($filename);
            }

            $user->setOnBoardingComplete(true);
            $this->userManager->update($user);

            return $this->redirectToRoute('customer_user_profile');
        }

        return $this->render('customer/user/onboarding/step_three.html.twig', [
            'user' => $user,
            'on_boarding_step_three_form' => $form->createView(),
        ]);
    }

    #[Route('/skip', name: 'customer_onboarding_skip')]
    #[Security('is_granted("ROLE_USER")')]
    public function skip(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $user->setOnBoardingComplete(true);
        $user->setDateUpdated(new \DateTime());

        $this->userManager->save($user);

        return $this->redirectToRoute('customer_user_profile');
    }
}
