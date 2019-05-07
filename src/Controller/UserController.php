<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController {

    public function home() {
        $data = [
            "name" => "Melkorchi",
            "age" => 28,
            "notes" => [20,18,17],
        ];

        return $this->render('home/home.html.twig', $data);
    }

    public function register() {
        return $this->render('home/register.html.twig');
    }

    public function getLogin() {
        return $this->redirectToRoute('index');
    }

    public function login(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();
        $email = $authenticationUtils->getLastUsername();

        return new Response(
            '<html><body>LOGIN PAGE</body></html>'
        );
    }


}