<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Conference;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\Admin\ConferenceCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ConferenceCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Guestbook');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Conferences', 'fas fa-map-marker-alt', Conference::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-shop', Product::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tags', Category::class);
        yield MenuItem::linkToCrud('Admin', 'fas fa-tags', Admin::class);
    }
}
