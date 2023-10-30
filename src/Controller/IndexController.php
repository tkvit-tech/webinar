<?php

namespace App\Controller;

use App\Services\Menu;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Menu $menu): Response
    {
        dump($menu->index());
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'test' => $menu->index()

        ]);
    }
}
