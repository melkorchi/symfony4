<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use App\Entity\User;

class SuperController extends AbstractController {

    protected function returnJson($data, $status = 200) {
        return new Response(json_encode($data), $status, ["Content-type" => "application/json"]);
    }


}