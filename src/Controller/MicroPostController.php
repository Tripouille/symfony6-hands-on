<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post')]
    public function index(MicroPostRepository $repository): Response
    {
        return $this->render('micro_post/index.html.twig', [
            'posts' => $repository->findAll(),
        ]);
    }

    #[Route('/micro-post/{id<\d+>}')]
    public function showOne(MicroPost $post): Response {
        return $this->render('micro_post/show-one.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/{id<\d+>}/edit')]
    public function edit(MicroPost $post, Request $request, MicroPostRepository $repository): Response
    {
        $form = $this->createForm(MicroPostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            $repository->add($post, true);
            $this->addFlash('success', 'Post was updated');
            return $this->redirectToRoute('app_micropost_index');
        }

        return $this->renderForm('micro_post/edit.html.twig', [
            'form' => $form,
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add')]
    public function add(Request $request, MicroPostRepository $repository): Response
    {
        $post = new MicroPost();
        $form = $this->createForm(MicroPostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
           $post = $form->getData();
           $post->setCreated(new \DateTimeImmutable());
           $repository->add($post, true);
           $this->addFlash('success', 'Post was created');
           return $this->redirectToRoute('app_micropost_index');
        }

        return $this->renderForm('micro_post/add.html.twig', [
            'form' => $form,
        ]);
    }
}
