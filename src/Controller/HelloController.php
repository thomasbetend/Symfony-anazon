<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{name<\w+>}', methods: ['GET'], name: 'app_hello')]
    public function index(string $name = 'Bobby'): Response
    {
        //dd($request->headers);

        return $this->render('hello/index.html.twig', [
            'category' => [
                'title' =>'Hello '.$name,
                'title2' =>'Hello '.$name,
                'title3' =>'Hello '.$name,
                'title4' =>'Hello '.$name,
            ],
        ]);
    }
}
