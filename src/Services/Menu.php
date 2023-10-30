<?php

namespace App\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Twig\TemplateWrapper;

class Menu
{
    private $entityManager;
    private $templateWraper;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
        //$this->templateWraper = $templateWrapper;
    }
    public function index()
    {
        //$entityManager = new EntityManager();
        $menu = $this->entityManager->getRepository(\App\Entity\Menu::class)->findBy(['parent_id' => 0]);

        return $menu;
    }
}