<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{

    private array $messages = [
        ['content'=> 'Hello', 'created'=> '2022/06/12'],
        ['content'=> 'Goodbye', 'created'=> '2022/06/13'],
        ['content'=> 'Good morning', 'created'=> '2022/06/14'],
    ];

    #[Route('/')]
    public function index(): Response
    {
        return $this->render(
            'hello/index.html.twig',
            ['messages' => $this->messages]
        );
    }

    #[Route('/limit/{limit<\d+>?}')]
    public function limit($limit): Response
    {
        return $this->render(
            'hello/limit.html.twig',
            ['messages' => $this->messages,
                'limit' => $limit,
            ]);
    }

    #[Route('show/{id<\d+>}')]
    public function showOne(int $id): Response {
        return $this->render(
            'hello/show.html.twig', [
            'message' => $this->messages[$id]
        ]);
    }
}