<?php

namespace ProgramerHakim\Project\PHP\MVC\Repository;

use PHPUnit\Framework\TestCase;
use ProgramerHakim\Project\PHP\MVC\Config\Database;
use ProgramerHakim\Project\PHP\MVC\Domain\Session;
use ProgramerHakim\Project\PHP\MVC\Domain\User;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;
    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();
        $user = new User();
        $user->id = "hakim";
        $user->name = "Hakim";
        $user->password = "rahasia";
        $this->userRepository->save($user);
    }
    public function testSaveSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "hakim";
        $this->sessionRepository->save($session);
        $result = $this->sessionRepository->findById($session->id);
        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);
    }
    public function testDeleteByIdSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->userId = "hakim";
        $this->sessionRepository->save($session);
        $result = $this->sessionRepository->findById($session->id);
        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);
        $this->sessionRepository->deleteById($session->id);
        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }
    public function testFindByIdNotFound()
    {
        $result = $this->sessionRepository->findById('notfound');
        self::assertNull($result);
    }
}
