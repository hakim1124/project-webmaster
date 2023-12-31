<?php

namespace ProgramerHakim\Project\PHP\MVC\App {
    function header(string $value)
    {
        echo $value;
    }
}

namespace ProgramerHakim\Project\PHP\MVC\Middleware {

    use PHPUnit\Framework\TestCase;
    use ProgramerHakim\Project\PHP\MVC\Config\Database;
    use ProgramerHakim\Project\PHP\MVC\Domain\Session;
    use ProgramerHakim\Project\PHP\MVC\Domain\User;
    use ProgramerHakim\Project\PHP\MVC\Repository\SessionRepository;
    use ProgramerHakim\Project\PHP\MVC\Repository\UserRepository;
    use ProgramerHakim\Project\PHP\MVC\Service\SessionService;

    class MustLoginMiddlewareTest extends TestCase
    {
        private MustLoginMiddleware $middleware;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;
        protected function setUp(): void
        {
            $this->middleware = new MustLoginMiddleware();
            putenv("mode=test");
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->sessionRepository = new SessionRepository(Database::getConnection());
            $this->sessionRepository->deleteAll();
            $this->userRepository->deleteAll();
        }
        public function testBeforeGuest()
        {
            $this->middleware->before();
            $this->expectOutputRegex("[Location: /users/login]");
        }
        public function testBeforeLoginUser()
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
            $this->middleware->before();
            $this->expectOutputString("");
        }
    }
}
