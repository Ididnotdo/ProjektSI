<?php
/**
 * User service.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * Class UserService.
 */
class UserService
{
    private UserRepository $userRepository;

    /**
     * Constructor.
     *
     * @param UserRepository $userRepository User repository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Save entity.
     *
     * @param User $user User entity
     */
    public function save(User $user): void
    {
        $this->userRepository->save($user, true);
    }

    /**
     * Update password.
     *
     * @param PasswordAuthenticatedUserInterface $user     User entity
     * @param string                             $password Password
     */
    public function updatePassword(PasswordAuthenticatedUserInterface $user, string $password): void
    {
        $this->userRepository->upgradePassword($user, $password);
    }
}
