<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\ProductMove;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Unit;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $productsCount = $manager->getRepository(Product::class)->count([]);
        $productsValue = $manager->getRepository(ProductMove::class)->getSumWithProduct();
        $productsStock = $manager->getRepository(ProductMove::class)->getProductsTotalStock();

        return $this->render('Admin/index.html.twig',
            [
                'productsCount' => $productsCount,
                'stock' => $productsStock,
                'warehouseValue' => $productsValue,
            ]);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Warehouse');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Product move'),
            MenuItem::linkToCrud('Move', 'fa fa-exchange-alt', ProductMove::class),
            MenuItem::section('Lists'),
            MenuItem::linkToCrud('Products', 'fa fa-list', Product::class),
            MenuItem::linkToCrud('Categories', 'fa fa-list', Category::class),
            MenuItem::linkToCrud('Units', 'fa fa-list', Unit::class),
        ];
    }
}
