<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'users', methods:["GET"])]
    public function users(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render(
            'user/readUser.html.twig',
            ['users' => $users]
        );
    }

    #[Route('/user/create', name: 'create_user_page', methods: ['GET'])]
    public function createProductPage(): Response
    {
        return $this->render('user/createUser.html.twig');
    }

    #[Route('/user/create', name: 'create_user', methods: ['POST'])]
    public function createUser(EntityManagerInterface $em, Request $request): Response
    {
        $user = new User();

        $user->setFirstName($request->request->get('first_name'));
        $user->setSecondName($request->request->get('second_name'));
        $user->setLastName($request->request->get('last_name'));
        $user->setAddress($request->request->get('address'));
        $user->setPhone($request->request->get('phone'));
        $user->setEmail($request->request->get('email'));

        $em->persist($user);

        $em->flush();

        return $this->redirect('/user');
    }

    #[Route('/user/edit/{user}', name: 'edit_page', methods: ['POST'])]
    public function editPage(User $user): Response
    {
        return $this->render(
            'user/editUser.html.twig',
            ['user' => $user]
        );
    }

    #[Route('/user/edit/{user}', name: 'edit', methods: ['PUT'])]
    public function edit(User $user, Request $request, EntityManagerInterface $em): Response
    {
        $user->setFirstName($request->request->get('first_name'));
        $user->setLastName($request->request->get('last_name'));
        $user->setSecondName($request->request->get('second_name'));
        $user->setAddress($request->request->get('address'));
        $user->setPhone($request->request->get('phone'));
        $user->setEmail($request->request->get('email'));

        $em->flush();

        return $this->redirect('/user');
    }

    #[Route('/user/delete/{user}', name: 'delete_user', methods: ["DELETE"])]
    public function deleteUser(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);

        $em->flush();

        return $this->redirect('/user');
    }
}
