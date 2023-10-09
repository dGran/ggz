<?php

declare(strict_types=1);

namespace App\Controller\Customer\Auth;

use App\Manager\UserManager;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\FacebookUser;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FacebookController extends AbstractController
{
    private UserManager $userManager;
    private LoggerInterface $logger;

    public function __construct(UserManager $userManager, LoggerInterface $logger)
    {
        $this->userManager = $userManager;
        $this->logger = $logger;
    }

    /**
     * @Route("/connect/facebook", name="connect_facebook_start")
     */
    public function connectAction(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry
            ->getClient('facebook')
            ->redirect([
                'public_profile', 'email' // the scopes you want to access
            ]);
    }

    /**
     * @Route("/connect/facebook/check", name="connect_facebook_check")
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry): void
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
        // (read below)

        /** @var FacebookClient $client */
        $client = $clientRegistry->getClient('facebook');

        try {
            // the exact class depends on which provider you're using
            /** @var FacebookUser $facebookUser */
            $facebookUser = $client->fetchUser();

            var_dump($facebookUser); die;

            $facebookEmail = $facebookUser->getEmail();
            $user = $this->userManager->findByEmail($facebookEmail);

            if (empty($user)) {
                $user = $this->userManager->create();
                $user->setEmail($facebookEmail);
                $user->setProfilePic($facebookUser->getPictureUrl());
                $user->setNickname($facebookUser->getName());
                $user->setVerified(true);
                $this->userManager->save($user);

//                TODO: redirect to onBoarding

                return;
            }

//            TODO: authenticate user and redirect to profile or home (decidir con Carlos)
        } catch (IdentityProviderException $exception) {
            // something went wrong!
            // probably you should return the reason to the user
            var_dump($exception->getMessage()); die;

            $this->logger->warning(\date(DATE_W3C).' - '.__METHOD__.' Connection error to facebook account with message: '.$exception->getMessage());
//            TODO: redirect con mensaje flash
        }
    }
}