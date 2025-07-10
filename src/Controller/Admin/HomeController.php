<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin', name: 'admin.home.')]
final class HomeController extends AbstractController
{
    public function __construct()
    {
    }
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/home/home.html.twig', [
            'title' => 'Admin Dashboard',
            'description' => 'Welcome to the admin dashboard.',
        ]);
    }
}