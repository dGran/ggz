<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use App\Form\Customer\User\AccountSettingsEmailType;
use App\Form\Customer\User\AccountSettingsNicknameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user-settings', name: 'customer_user_settings')]
#[Security('is_granted("ROLE_USER")')]
class SettingController extends AbstractController
{
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $formNickname = $this->createForm(
            AccountSettingsNicknameType::class,
            $user,
            [
                'action' => $this->generateUrl('customer_user_settings_update_nickname', ['user' => $user->getId()]),
                'method' => 'POST',
                'attr' => [
                    'id' => 'customer_user_settings_update_nickname',
                ],
            ]
        );

        $formEmail = $this->createForm(
            AccountSettingsEmailType::class,
            $user,
            [
                'action' => $this->generateUrl('customer_user_settings_add_email_request', ['user' => $user->getId()]),
                'method' => 'POST',
                'attr' => [
                    'id' => 'customer_user_settings_add_email_request',
                ],
            ]
        );

        $formNicknameView = $formNickname->createView();
        $formEmailView = $formEmail->createView();

        return $this->render('customer/user/settings/index.html.twig', [
            'user' => $user,
            'form_nickname' => $formNicknameView,
            'form_email' => $formEmailView,
        ]);
    }
}
