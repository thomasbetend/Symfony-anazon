<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(CategoryRepository $categoryRepository): Response
    {
        return $this->render('hello/index.html.twig');
    }

    #[Route(path: '/logout2', name: 'app_logout2')]
    public function logout2(string $name = 'Bobby'): Response
    {
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
