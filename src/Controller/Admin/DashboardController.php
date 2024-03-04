<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use App\Entity\Personnels;
use App\Entity\Equipements;
use App\Entity\TypeMateriels;
use App\Entity\Reparations;
use App\Entity\PiecesChanger;
use App\Entity\Pannes;
use App\Entity\Modeles;
use App\Entity\Marques;
use App\Entity\Caracteristiques;
use App\Entity\Emplacements;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       
        return $this->render('admin/my_dashboard.html.twig', [
            //'chart' => $chart,
        ]);
        //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //return $this->redirect($adminUrlGenerator->setController(PersonnelsCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Parcinfoilead')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Personnels::class);
        yield MenuItem::linkToCrud('Equipements', 'fas fa-laptop-house', Equipements::class);
        yield MenuItem::linkToCrud('Type d\'equipement', 'fas fa-list', TypeMateriels::class);
        yield MenuItem::linkToCrud('Caractéristiques', 'fas fa-info-circle', Caracteristiques::class);
        yield MenuItem::linkToCrud('Marques', 'fas fa-list', Marques::class);
        yield MenuItem::linkToCrud('Modèles', 'fas fa-list', Modeles::class);
        yield MenuItem::linkToCrud('Localisation', 'fas fa-sitemap', Emplacements::class);
        yield MenuItem::linkToCrud('Pannes', 'fas fa-wrench', Pannes::class);
        yield MenuItem::linkToCrud('Réparations', 'fas fa-toolbox', Reparations::class);
        yield MenuItem::linkToCrud('Pièce de rechange', 'fas fa-puzzle-piece', PiecesChanger::class);
        
    }
}
