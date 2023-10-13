<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use App\Form\Customer\User\OnBoardingStepOneType;
use App\Form\Customer\User\OnBoardingStepThreeType;
use App\Form\Customer\User\OnBoardingStepTwoType;
use App\Helper\AvatarResizer;
use App\Manager\UserManager;
use App\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/onboarding')]
class OnBoardingController extends AbstractController
{
    private const PROJECT_DIR = 'kernel.project_dir';

    private const PUBLIC_FOLDER = '/public/';

    private UserManager $userManager;

    private UserService $userService;

    private AvatarResizer $avatarResizer;

    public function __construct(UserManager $userManager, UserService $userService, AvatarResizer $avatarResizer)
    {
        $this->userManager = $userManager;
        $this->userService = $userService;
        $this->avatarResizer = $avatarResizer;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
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
            $nickname = $form->get('nickname')->getData();

            if (!$this->userService->isValidNickname($nickname, $user->getId())) {
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
    public function stepThree(Request $request): Response
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
                $destination = $this->getParameter(self::PROJECT_DIR).self::PUBLIC_FOLDER.User::PROFILE_PIC_PATH;
                $profilePicName = $this->avatarResizer->resizeAndCompressImage($profilePicFile, $destination);

                $user->setProfilePic($profilePicName);
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
        $this->userManager->update($user);

        return $this->redirectToRoute('customer_user_profile');
    }
}
