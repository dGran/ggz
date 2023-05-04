<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListsController extends AbstractController
{
    private CountryRepository $countryRepository;
    
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    #[Route('/lists', name: 'app_lists')]
    public function index(): Response
    {
        $countries= $this->countryRepository->findBy(['isoCode' => 'ITA']);
        $text= 'Hello World!';
        
        return $this->render('lists/index.html.twig', [
            'countries' => $countries,
            'text' => $text,    
        ]);
    }
}