<?php

namespace ProgramerHakim\Project\PHP\MVC\Controller;

use ProgramerHakim\Project\PHP\MVC\App\View;
use ProgramerHakim\Project\PHP\MVC\Config\Database;
use ProgramerHakim\Project\PHP\MVC\Repository\SessionRepository;
use ProgramerHakim\Project\PHP\MVC\Repository\UserRepository;
use ProgramerHakim\Project\PHP\MVC\Service\SessionService;

class HomeController
{
    private SessionService $sessionService;
    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    function index()
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::render('Home/index', [
                'title' => 'Programer Hakim'
            ]);
        } else {
            View::render('Home/dashboard', [
                'title' => 'dashboard',
                'user' => ['name' => $user->name]
            ]);
        }
    }
}
