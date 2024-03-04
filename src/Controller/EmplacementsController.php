<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmplacementsController extends AbstractController
{
    #[Route('/emplacements', name: 'app_emplacements',methods:['GET'])]
    public function index(): Response
    {
        return $this->render('emplacements/index.html.twig', [
            'controller_name' => 'EmplacementsController',
        ]);
    }
}
