<?php
/**
 * User service.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
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
        /**if (null == $category->getId()) {
        $category->setCreatedAt(new \DateTimeImmutable());
        }
        $category->setUpdatedAt(new \DateTimeImmutable());
        `*/
        $this->userRepository->save($user, true);
    }
    /**
     * Save entity.
     *
     * @param User $user User entity
     */
    public function updatePassword(PasswordAuthenticatedUserInterface $user, string $password): void
    {
        /**if (null == $category->getId()) {
        $category->setCreatedAt(new \DateTimeImmutable());
        }
        $category->setUpdatedAt(new \DateTimeImmutable());
        `*/
        $this->userRepository->upgradePassword($user, $password);
    }
}