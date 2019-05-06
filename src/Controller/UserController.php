<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
}