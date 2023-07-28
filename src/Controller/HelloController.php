<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    private array $values = [1, 2, 3];

    #[Route('/')]
    public function index(): Response
    {
        return new Response(\implode(',', $this->values));
    }

    #[Route('show/{id}')]
    public function showOne($id): Response {
        return new Response($this->values[$id]);
    }
}