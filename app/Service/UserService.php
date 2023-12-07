<?php

namespace ProgramerHakim\Project\PHP\MVC\Service;

use ProgramerHakim\Project\PHP\MVC\Config\Database;
use ProgramerHakim\Project\PHP\MVC\Domain\User;
use ProgramerHakim\Project\PHP\MVC\Exception\ValidationException;
use ProgramerHakim\Project\PHP\MVC\Model\UserLoginRequest;
use ProgramerHakim\Project\PHP\MVC\Model\UserLoginResponse;
use ProgramerHakim\Project\PHP\MVC\Model\UserPasswordUpdateRequest;
use ProgramerHakim\Project\PHP\MVC\Model\UserPasswordUpdateResponse;
use ProgramerHakim\Project\PHP\MVC\Model\UserProfileUpdateRequest;
use ProgramerHakim\Project\PHP\MVC\Model\UserProfileUpdateResponse;
use ProgramerHakim\Project\PHP\MVC\Model\UserRegisterRequest;
use ProgramerHakim\Project\PHP\MVC\Model\UserRegisterResponse;
use ProgramerHakim\Project\PHP\MVC\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if ($user != null) {
                throw new ValidationException("user Id already exist");
            }
            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $this->userRepository->save($user);
            $response = new UserRegisterResponse();
            $response->user = $user;
            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if (
            $request->id == null || $request->name == null || $request->password == null
            || trim($request->id) == "" || trim($request->name) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Id, Name, Password can not blank");
        }
    }
    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->ValidateUserLoginRequest($request);
        $user = $this->userRepository->findById($request->id);
        if ($user == null) {
            throw new ValidationException("id or password is wrong");
        }
        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("id or password is wrong");
        }
    }
    private function ValidateUserLoginRequest(UserLoginRequest $request)
    {
        if (
            $request->id == null || $request->password == null
            || trim($request->id) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Id, Password can not blank");
        }
    }
    public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
    {
        $this->ValidateUserProfileUpdateRequest($request);
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if ($user == null) {
                throw new ValidationException("User is not found");
            }
            $user->name = $request->name;
            $this->userRepository->update($user);
            Database::commitTransaction();
            $response = new UserProfileUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function ValidateUserProfileUpdateRequest(UserProfileUpdateRequest $request)
    {
        if (
            $request->id == null || $request->name == null
            || trim($request->id) == "" || trim($request->name) == ""
        ) {
            throw new ValidationException("Id, Name can not blank");
        }
    }
    public function updatePassword(UserPasswordUpdateRequest $request): UserPasswordUpdateResponse
    {
        $this->validateUserPasswordUpdateRequest($request);
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if ($user == null) {
                throw new ValidationException("User is not found");
            }
            if (!password_verify($request->oldPassword, $user->password)) {
                throw new ValidationException("Old password is wrong");
            }
            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);
            Database::commitTransaction();
            $response = new UserPasswordUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    private function validateUserPasswordUpdateRequest(UserPasswordUpdateRequest $request)
    {
        if (
            $request->id == null || $request->oldPassword == null || $request->newPassword == null
            || trim($request->id) == "" || trim($request->oldPassword) == "" || trim($request->newPassword) == ""
        ) {
            throw new ValidationException("Id, oldPassword, newPassword can not blank");
        }
    }
}
