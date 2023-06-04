<?php

namespace App\Controller;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'comment')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $comments = $entityManager->getRepository(Comment::class)->findAll();
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'FIRSTComment',
            'comments' => $comments
        ]);
    }

    #[Route('/comment/single/{id}', name: 'single_comment')]
    public function single(Comment $id)
    {
        return $this->render('comment/single.html.twig', [
            'comment' => $id
        ]);
    }

    #[Route('/comment/create', name: 'create_comment')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $comment = new Comment();
        $form = $this->createForm(commentType::class, $comment);
    }

}
