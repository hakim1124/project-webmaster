<?php

namespace ProgramerHakim\Project\PHP\MVC\App {
    function header(string $value)
    {
        echo $value;
    }
}

namespace ProgramerHakim\Project\PHP\MVC\Service {
    function setcookie(string $name, string $value)
    {
        echo "$name: $value";
    }
}

namespace ProgramerHakim\Project\PHP\MVC\Controller {

    use PHPUnit\Framework\TestCase;
    use ProgramerHakim\Project\PHP\MVC\Config\Database;
    use ProgramerHakim\Project\PHP\MVC\Domain\Session;
    use ProgramerHakim\Project\PHP\MVC\Domain\User;
    use ProgramerHakim\Project\PHP\MVC\Repository\SessionRepository;
    use ProgramerHakim\Project\PHP\MVC\Repository\UserRepository;
    use ProgramerHakim\Project\PHP\MVC\Service\SessionService;

    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();
            $this->sessionRepository = new SessionRepository(Database::getConnection());
            $this->sessionRepository->deleteAll();
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();
            putenv("mode=test");
        }
        public function testRegister()
        {
            $this->userController->register();
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
        }
        public function testPostRegisterSuccess()
        {
            $_POST['id'] = 'hakim';
            $_POST['name'] = 'Hakim';
            $_POST['password'] = 'rahasia';
            $this->userController->postRegister();
            $this->expectOutputRegex("[Location: /users/login]");
        }
        public function testPostRegisterValidationError()
        {
            $_POST['id'] = '';
            $_POST['name'] = 'Hakim';
            $_POST['password'] = 'rahasia';
            $this->userController->postRegister();
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
            $this->expectOutputRegex("[Id, Name, Password can not blank]");
        }
        public function testPostRegisterDuplicate()
        {
            $user = new User();
            $user->id = 'hakim';
            $user->name = 'Hakim';
            $user->password = 'rahasia';
            $this->userRepository->save($user);
            $_POST['id'] = 'hakim';
            $_POST['name'] = 'Hakim';
            $_POST['password'] = 'rahasia';
            $this->userController->postRegister();
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
            $this->expectOutputRegex("[user Id already exist]");
        }
        public function testLogin()
        {
            $this->userController->login();
            $this->expectOutputRegex("[Login user]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
        }
        public function testLoginSuccess()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $_POST['id'] = "hakim";
            $_POST['password'] = "rahasia";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Location: /]");
            $this->expectOutputRegex("[X-PZN-SESSION: ]");
        }
        public function testLoginValidationError()
        {
            $_POST['id'] = "";
            $_POST['password'] = "";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login user]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Id, Password can not blank]");
        }
        public function testLoginUserNotFound()
        {
            $_POST['id'] = "notfound";
            $_POST['password'] = "notfound";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login user]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[id or password is wrong]");
        }
        public function testLoginWrongPassword()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $_POST['id'] = "hakim";
            $_POST['password'] = "salah";
            $this->userController->postLogin();
            $this->expectOutputRegex("[Login user]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[id or password is wrong]");
        }
        public function testLogout()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $this->userController->logout();
            $this->expectOutputRegex("[Location: /]");
            $this->expectOutputRegex("[X-PZN-SESSION: ]");
        }
        public function testUpdateProfile()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $this->userController->updateProfile();
            $this->expectOutputRegex("[Update Profile]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[hakim]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Hakim]");
        }
        public function testPostUpdateProfileSuccess()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $_POST['name'] = 'Zaidan';
            $this->userController->postUpdateProfile();
            $this->expectOutputRegex("[Location: /]");
            $result = $this->userRepository->findById("hakim");
            self::assertEquals("Zaidan", $result->name);
        }
        public function testPostUpdateProfileValidationError()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $_POST['name'] = '';
            $this->userController->postUpdateProfile();
            $this->expectOutputRegex("[Update Profile]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[hakim]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Id, Name can not blank]");
        }
        public function testUpdatePassword()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $this->userController->updatePassword();
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[hakim]");
        }
        public function testPostUpdatePasswordSuccess()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $_POST['oldPassword'] = "rahasia";
            $_POST['newPassword'] = "1124hk";
            $this->userController->postUpdatePassword();
            $this->expectOutputRegex("[Location: /]");
            $result = $this->userRepository->findById($user->id);
            self::assertTrue(password_verify("1124hk", $result->password));
        }
        public function testPostUpdatePasswordValidationError()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $_POST['oldPassword'] = "";
            $_POST['newPassword'] = "";
            $this->userController->postUpdatePassword();
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[hakim]");
            $this->expectOutputRegex("[Id, oldPassword, newPassword can not blank]");
        }
        public function testPostUpdatePasswordWrongOldPassword()
        {
            $user = new User();
            $user->id = "hakim";
            $user->name = "Hakim";
            $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $user->id;
            $this->sessionRepository->save($session);
            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;
            $_POST['oldPassword'] = "salah";
            $_POST['newPassword'] = "1124hk";
            $this->userController->postUpdatePassword();
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[hakim]");
            $this->expectOutputRegex("[Old password is wrong]");
        }
    }
}
