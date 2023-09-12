<?php

namespace App\Controller;

use App\Form\Type\ChangePasswordType;
use App\Form\Type\ChangeEmailType;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
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
     * Constructor.
     *
     * @param UserService $userService User service
     * @param TranslatorInterface      $translator  Translator
     */
    public function __construct(UserService $userService, TranslatorInterface $translator)
    {
        $this->userService = $userService;
        $this->translator = $translator;
    }

    /**
     * Change password.
     * @param AuthenticationUtils $authenticationUtils
     * @param UserInterface $user
     * @return Response
     */
    #[Route(path: 'change_password', name: 'change_password')]
    public function changePassword(Request $request, UserInterface $user, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (! $user instanceof User)
            return $this->redirectToRoute('task_index');

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
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/change_password.html.twig', ['user' => $user, 'error' => $error]);
    }
    /**
     * Change email.
     * @param AuthenticationUtils $authenticationUtils
     * @param UserInterface $user
     * @return Response
     */
    #[Route(path: '/change_email', name: 'change_email')]
    public function changeEmail(AuthenticationUtils $authenticationUtils, User $user,Request $request): Response
    {
        $form = $this->createForm(
            ChangeEmailType::class,
            $user,
            [
                'method' => 'PUT',
                'action' => $this->generateUrl('change_email', ['id' => $user->getId()]),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->save($user);

            $this->addFlash(
                'success',
                $this->translator->trans('email.changed_successfully')
            );

            return $this->redirectToRoute('task_index');
        }

        return $this->render(
            'user/change_email.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/change_email.html.twig', ['user' => $user, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}