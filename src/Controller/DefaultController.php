<?php
// src/Controller/DefaultController.php
namespace App\Controller;

// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

// class DefaultController extends Controller {
class DefaultController extends AbstractController {

    public function home(Request $request) {
        $name = $request->query->get("name");
        $aTab = ["01" => "Aliquam", "02" => "Tempus", "03" =>"Magna", "04" =>"Ipsum", "05" =>"Consequat", "06" =>"Etiam"];

        if (!empty($name)) {
            // shuffle($aTab);
            $aTab = $this->shuffleArray($name, $name);
            
        }

        $data = [
            // "name" => "Melkorchi",
            // "age" => 28,
            // "notes" => [20,18,17],
            "img" => $aTab
        ];

        // dd($this->shuffleArray($name, $name));

        return $this->render('home/home.html.twig', $data);
    }

    private function shuffleArray($name, $tab) {
        $newArray = [];
        // for($i = 0; $i < count($tab); $i++) { 
        //     if ($tab[$i] != $name) {
        //         array_push($newArray, $tab[$i]); 
        //     }
        //     array_rand($newArray);
        //     array_unshift($newArray, $name);

        //     return $newArray;
        // }
        foreach ($tab as $key => $val) { 
            if ($tab[$key] != $name) {
                array_push($newArray, $val); 
            }
            array_rand($newArray);
            array_unshift($newArray, $name);

            return $newArray;
        }
    }

    public function register() {
        return $this->render('home/register.html.twig');
    }
}