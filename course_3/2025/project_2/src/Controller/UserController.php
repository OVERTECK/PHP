<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Repository\DepartmentRepository;
use Doctrine\ORM\EntityManager;
use LDAP\Result;
use PhpParser\Builder\Method;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'list_users', methods: ['GET'])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $selectedFieldSort = $request->query->get('fieldSortSelect', '-1');
        $selectedTypeSorted = $request->query->get('typeSortSelect', '-1');
        $selectedSearchField = $request->query->get('selectedSearchField', '-1');
        $search = $request->query->get('q', '');

        $qb = $userRepository->createQueryBuilder('u');

        if ($search !== '' || $selectedSearchField !== '-1') {
            $qb->join('u.department', 'd')
                ->andWhere(":selectedSearchField LIKE :value")
                ->setParameter("selectedSearchField", $selectedSearchField)
                ->setParameter('value', "%$search%");
        }

        if ($selectedFieldSort !== '-1' && $selectedTypeSorted !== '-1') {
            $qb->orderBy("u.$selectedFieldSort", $selectedTypeSorted);
        }

        $finalQuery = $qb->getQuery();

        $users = $finalQuery->getResult();

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'selectedField' => $selectedFieldSort,
            'selectedTypeSorted' => $selectedTypeSorted,
            'search' => $search,
            'selectedSearchField' => $selectedSearchField,
        ]);
    }

    #[Route('/user/edit/{id}', name: 'edit_user', methods: ['GET'])]
    public function editUser(User $user, DepartmentRepository $department): Response
    {
        $departments = $department->findAll();

        return $this->render('user\edit.html.twig', [
            'user' => $user,
            'departments' => $departments
        ]);
    }

    #[Route('/user/edit/{user}', name: 'edit_user_main', methods: ['PUT'])]
    public function editUserMain(
        DepartmentRepository $departments,
        Request $request,
        User $user,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {

        $file = $request->files->get('image');

        $user->setPathToImage(null);

        if ($file) {
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $encodedFileName = $slugger->slug($fileName);
            $resultFileName = $encodedFileName . "-" . uniqid();

            $projectDir = $this->getParameter("kernel.project_dir");

            try {
                $file->move($projectDir . '/public/images', $resultFileName);

                $user->setPathToImage("/public/images/" . $resultFileName);
            } catch (FileException $ex) {
                echo $ex->getMessage();
            }
        }

        $department = $departments->find($request->request->get('departmentSelected'));

        $user->setDepartment($department);
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setAge($request->request->get('age'));
        $user->setStatus($request->request->get('status'));
        $user->setEmail($request->request->get('email'));
        $user->setTelegram($request->request->get('telegram'));
        $user->setAddress($request->request->get('address'));

        $em->flush();

        return $this->redirect('/user');
    }

    #[Route('/user/delete/{user}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();

        return $this->redirect('/user');
    }

    #[Route('/user/create', name: 'create_user_page', methods: ["GET"])]
    public function renderCreateUser(DepartmentRepository $departments): Response
    {
        $departments = $departments->findAll();

        return $this->render('/user/create.html.twig', [
            'departments' => $departments,
            'errors' => [],
        ]);
    }

    #[Route('/user/create', name: 'create_user', methods: ["POST"])]
    public function createUser(
        Request $request,
        DepartmentRepository $departments,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        ValidatorInterface $validator,
    ): Response {

        $newUser = new User();

        $file = $request->files->get('image');

        if ($file) {
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $encodedFileName = $slugger->slug($fileName);
            $resultFileName = $encodedFileName . "-" . uniqid();

            $projectDir = $this->getParameter("kernel.project_dir");

            try {
                $file->move($projectDir . '/public/images', $resultFileName);
                $newUser->setPathToImage("public/images/" . $resultFileName);
            } catch (FileException $ex) {
                echo $ex->getMessage();
            }
        }

        $department = $departments->find($request->request->get('departmentSelected'));

        $newUser->setDepartment($department);
        $newUser->setFirstName($request->request->get('firstName'));
        $newUser->setLastName($request->request->get('lastName'));

        $age = $request->request->get('age');
        $age = $age == "" ? null : $age;

        $newUser->setAge($age);
        $newUser->setStatus($request->request->get('status'));
        $newUser->setEmail($request->request->get('email'));
        $newUser->setTelegram($request->request->get('telegram'));
        $newUser->setAddress($request->request->get('address'));

        $errors = $validator->validate($newUser);

        if ($errors->count() > 0) {
            return $this->render("user/create.html.twig", [
                'errors' => $errors,
                'departments' => $departments->findAll(),
            ]);
        }

        $em->persist($newUser);
        $em->flush();

        return $this->redirect('/user');
    }

    #[Route('/', name: 'main')]
    public function mainPage(): Response
    {
        return $this->redirect('/user');
    }
}
