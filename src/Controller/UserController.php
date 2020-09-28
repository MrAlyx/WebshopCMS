<?php

namespace App\Controller;

use App\Entity\Base;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\BaseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, BaseRepository $baseRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user, BaseRepository $baseRepository): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, BaseRepository $baseRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @route("{id}/role", name="role_action", methods="GET|POST")
     */

    public function roleAction($id, UserRepository $userRepository, BaseRepository $baseRepository): Response
    {
        $user = $userRepository->find($id);
        $role = 'ROLE_ADMIN';
        $roles = $user->getRoles();
        if ($user) {
            if (in_array($role, $roles)) {
                unset($roles[1]);
                $roles = array_values($roles);
                $user->setRoles($roles);
            } else {
                $roles[] = strtoupper($role);
                $user->setRoles($roles);
            }
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render('User/index.html.twig', [
            'users' => $userRepository->findAll(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }
}

