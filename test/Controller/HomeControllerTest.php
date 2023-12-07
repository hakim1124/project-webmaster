<?php

namespace ProgramerHakim\Project\PHP\MVC\Controller;

use PHPUnit\Framework\TestCase;
use ProgramerHakim\Project\PHP\MVC\Config\Database;
use ProgramerHakim\Project\PHP\MVC\Domain\Session;
use ProgramerHakim\Project\PHP\MVC\Domain\User;
use ProgramerHakim\Project\PHP\MVC\Repository\SessionRepository;
use ProgramerHakim\Project\PHP\MVC\Repository\UserRepository;
use ProgramerHakim\Project\PHP\MVC\Service\SessionService;

class HomeControllerTest extends TestCase
{
    private HomeController $homeController;
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;
    protected function setUp(): void
    {
        $this->homeController = new HomeController();
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();
    }
    public function testGuest()
    {
        $this->homeController->index();
        $this->expectOutputRegex("[Login]");
    }
    public function testUserLogin()
    {
        $user = new User();
        $user->id = "hakim";
        $user->name = "Hakim";
        $user->password = "rahasia";
        $this->userRepository->save($user);
        $session = new Session();
        $session->id = uniqid();
        $session->userId = $user->id;
        $this->sessionRepository->save($session);
        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
        $this->homeController->index();
        $this->expectOutputRegex("[Selamat Datang Hakim]");
    }
}
