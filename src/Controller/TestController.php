<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TestController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function indexAction()
    {
        return $this->render('test/index.html.twig', ['a' => 1234]);
    }

}