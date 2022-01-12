<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;

class ActivateAccountService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function activate(string $id, string $token): User
    {
        $user = $this->userRepository->findOneInactiveByIdAndTokenOrFail($id, $token);

        $user->setActive(true);
        $user->setToken(null);

        $this->userRepository->save($user);

        return $user;
    }
}