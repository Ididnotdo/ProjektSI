<?php
/**
 * User controller.
 */

namespace App\Controller;

use App\Form\Type\ChangePasswordType;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController.
 */
class UserController extends AbstractController
{
    /**
     * User service.
     */
    private UserService $userService;
    /**
     * Translator Interface.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param UserService         $userService User service
     * @param TranslatorInterface $translator  Translator
     */
    public function __construct(UserService $userService, TranslatorInterface $translator)
    {
        $this->userService = $userService;
        $this->translator = $translator;
    }

    /**
     * Change password.
     *
     * @param Request                     $request            request
     * @param UserInterface               $user               User Interface
     * @param UserPasswordHasherInterface $userPasswordHasher Password Hasher
     *
     * @return Response Response
     */
    #[Route(path: 'change_password', name: 'change_password')]
    public function changePassword(Request $request, UserInterface $user, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$user instanceof User) {
            return $this->redirectToRoute('task_index');
        }

        $form = $this->createForm(
            ChangePasswordType::class,
            $user,
            [
                'method' => 'PUT',
                'action' => $this->generateUrl('change_password'),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->SetPassword($userPasswordHasher->hashPassword($user, $user->GetPassword()));
            $this->userService->save($user);

            $this->addFlash(
                'success',
                $this->translator->trans('password.changed_successfully')
            );

            return $this->redirectToRoute('task_index');
        }

        return $this->render(
            'user/change_password.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/change_password.html.twig', ['user' => $user, 'error' => $error]);
    }

    /**
     * Log out.
     */
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
