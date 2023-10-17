<?php

namespace ProgramerHakim\Project\PHP\MVC\Controller;

use ProgramerHakim\Project\PHP\MVC\App\View;

class HomeController
{
    function index(): void  //contoh model sederhana tanpa database
    {
        $model = [
            "title" => "PHP MVC",
            "conten" => "Programer Hakim"
        ];
        // echo "HomeController.index()";
        // require __DIR__ . '/../View/Home/index.php';
        View::render('Home/index', $model);
    }
    function hello(): void
    {
        echo "HomeController.hello()";
    }
    function world(): void
    {
        echo "HomeController.world()";
    }
    function login(): void  //contoh model sederhana tanpa database
    {
        $request = [
            "username" => $_POST["username"],
            "password" => $_POST["password"]
        ];
        $user = [];
        $response = [
            "message" => "login sukses"  //mengirimkan respon ke view
        ];
    }
}
