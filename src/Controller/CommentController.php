<?php

namespace App\Controller;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $comment = $form->getData();
            $comment->setCreatedAt(new \DateTime('now'));
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('comment');
        }

        return $this->render('comment/form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/comment/update/{id}', name: 'update_comment')]
    public function update(Request $request, EntityManagerInterface $entityManager, $id)
    {
        $comment = $entityManager->getRepository(Comment::class)->find($id);
        $form = $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid())
        {
            $comment = $form->getData();
            $comment->setUpdatedAt(new \DateTime('now'));
            $entityManager->flush();
            return $this->redirectToRoute('comment');
        }

        return $this->render('comment/form.html.twig',[
            'form' => $form
        ]);

    }

    #[Route('/comment/delete/{id}', name: 'delete_comment')]
    public function delete(Request $request, EntityManagerInterface $entityManager, $id)
    {
        $comment = $entityManager->getRepository(Comment::class)->find($id);
        $entityManager->remove($comment);
        $entityManager->flush();
        return $this->redirectToRoute('comment');
    }
}
