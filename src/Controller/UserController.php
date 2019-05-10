<?php

namespace App\Controller;

//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\SuperController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\User;

class UserController extends SuperController {

    public function home() {
        $data = [
            "name" => "Melkorchi",
            "age" => 28,
            "notes" => [20,18,17],
        ];

        return $this->render('home/home.html.twig', $data);
    }

    public function register(Request $request, UserPasswordEncoderInterface $encodePass) {
        if (!filter_var($request->get("email"), FILTER_VALIDATE_EMAIL))
            return $this->returnJson("Invalid email syntax", 403);

        $er = $this->getDoctrine()->getRepository(User::class);

        $theUser = $er->findOneBy(["email" => $request->get("email")]);

        if (!$theUser) {
            $em = $this->getDoctrine()->getManager();
            $user = new User($request->get("name"), $request->get("email"), $request->get("password"));
            $user->setPassword($encodePass->encodePassword($user, $request->get("password")));

            try {
                $em->persist($user);
                $em->flush();
                return $this->returnJson("User Created", 200);
            } catch(Doctrine\ORM\EntityNotFoundException $e) {
                return $this->returnJson([ $e->getMessage() ], 403);
            }
        } else {
            dd($theUser);
            return $this->returnJson("Email already exists", 403);
        }

    }

    public function getLogin() {
        return $this->redirectToRoute('index');
    }

    public function login(AuthenticationUtils $authenticationUtils) {
    
        $error = $authenticationUtils->getLastAuthenticationError();
        $email = $authenticationUtils->getLastUsername();

        return $this->render('home/register.html.twig');
    }


}