<?php

namespace ProgramerHakim\Project\PHP\MVC\Controller;

use ProgramerHakim\Project\PHP\MVC\App\View;
use ProgramerHakim\Project\PHP\MVC\Config\Database;
use ProgramerHakim\Project\PHP\MVC\Exception\ValidationException;
use ProgramerHakim\Project\PHP\MVC\Model\UserLoginRequest;
use ProgramerHakim\Project\PHP\MVC\Model\UserPasswordUpdateRequest;
use ProgramerHakim\Project\PHP\MVC\Model\UserProfileUpdateRequest;
use ProgramerHakim\Project\PHP\MVC\Model\UserRegisterRequest;
use ProgramerHakim\Project\PHP\MVC\Repository\SessionRepository;
use ProgramerHakim\Project\PHP\MVC\Repository\UserRepository;
use ProgramerHakim\Project\PHP\MVC\Service\SessionService;
use ProgramerHakim\Project\PHP\MVC\Service\UserService;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;
    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    public function register() //untuk menampilkan halaman registrasi
    {
        View::render('User/register', ['title' => 'Register new User']);
    }
    public function postRegister() //untuk aksi registrasi
    {
        $request = new UserRegisterRequest();
        $request->id = $_POST['id']; //ini diambil dari form User/register.php
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];
        //kita kirimkan id, name, password ke userService->register()
        try {
            //kita kirimkan
            $this->userService->register($request);
            //jika sukses maka akan redirect ke halaman login
            View::redirect('/users/login');
        } catch (ValidationException $exception) {
            //jika terjadi error maka render menampilkan pesan error
            View::render('User/register', [
                'title' => 'Register new User',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function login()
    {
        View::render('User/login', ["title" => "Login user"]);
    }
    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->id = $_POST['id'];
        $request->password = $_POST['password'];
        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->id);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/login', [
                'title' => 'Login new User',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect("/");
    }
    public function updateProfile()
    {
        $user = $this->sessionService->current();
        View::render('User/profile', [
            "title" => "Update user profile",
            "user" => [
                "id" => $user->id,
                "name" => $user->name
            ]
        ]);
    }
    public function postUpdateProfile()
    {
        $user = $this->sessionService->current();
        $request = new UserProfileUpdateRequest();
        $request->id = $user->id;
        $request->name = $_POST['name'];
        try {
            $this->userService->updateProfile($request);
            View::redirect("/");
        } catch (ValidationException $exception) {
            View::render('User/profile', [
                "title" => "Update user profile",
                "error" => $exception->getMessage(),
                "user" => [
                    "id" => $user->id,
                    "name" => $_POST['name']
                ]
            ]);
        }
    }
    public function updatePassword()
    {
        $user = $this->sessionService->current();
        View::render('User/password', [
            "title" => "Update user password",
            "user" => [
                "id" => $user->id
            ]
        ]);
    }
    public function postUpdatePassword()
    {
        $user = $this->sessionService->current();
        $request = new UserPasswordUpdateRequest();
        $request->id = $user->id;
        $request->oldPassword = $_POST['oldPassword'];
        $request->newPassword = $_POST['newPassword'];
        try {
            $this->userService->updatePassword($request);
            View::redirect("/");
        } catch (ValidationException $exception) {
            View::render('User/password', [
                "title" => "Update user password",
                "error" => $exception->getMessage(),
                "user" => [
                    "id" => $user->id
                ]
            ]);
        }
    }
}
