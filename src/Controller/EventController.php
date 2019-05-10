<?php

namespace App\Controller;

//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\SuperController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\Event;

class EventController extends SuperController {

    public function register(Request $request) {
    
        $em = $this->getDoctrine()->getManager();
        $event = new Event($request->get("name"), $request->get("type"), $request->get("dateEvent"), $this->getUser());

        try {
            $em->persist($event);
            $em->flush();
            return $this->returnJson("Event Created", 200);
        } catch(Doctrine\ORM\EntityNotFoundException $e) {
            return $this->returnJson([ $e->getMessage() ], 403);
        }

    }
}