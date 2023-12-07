<?php

namespace ProgramerHakim\Project\PHP\MVC\Middleware;

use ProgramerHakim\Project\PHP\MVC\App\View;
use ProgramerHakim\Project\PHP\MVC\Config\Database;
use ProgramerHakim\Project\PHP\MVC\Repository\SessionRepository;
use ProgramerHakim\Project\PHP\MVC\Repository\UserRepository;
use ProgramerHakim\Project\PHP\MVC\Service\SessionService;

class MustNotLoginMiddleware implements Middleware
{
    private SessionService $sessionService;
    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    function before(): void
    {
        $user = $this->sessionService->current();
        if ($user != null) {
            View::redirect("/");
        }
    }
}
