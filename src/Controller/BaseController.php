<?php

namespace App\Controller;

use App\Entity\Base;
use App\Form\BaseType;
use App\Repository\BaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/base")
 */
class BaseController extends AbstractController
{
    /**
     * @Route("/", name="base_index", methods={"GET"})
     */
    public function index(BaseRepository $baseRepository): Response
    {
        return $this->render('base/index.html.twig', [
            'bases' => $baseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="base_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $base = new Base();
        $base->setUser($this->getUser());
        $base->setUpdatedAt(new \DateTime('now'));
        $form = $this->createForm(BaseType::class, $base);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($base);
            $entityManager->flush();

            return $this->redirectToRoute('base_index');
        }

        return $this->render('base/new.html.twig', [
            'base' => $base,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="base_show", methods={"GET"})
     */
    public function show(Base $base): Response
    {
        return $this->render('base/show.html.twig', [
            'base' => $base,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="base_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Base $base): Response
    {
        $base->setUser($this->getUser());
        $base->setUpdatedAt(new \DateTime('now'));
        $form = $this->createForm(BaseType::class, $base);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('base_index');
        }

        return $this->render('base/edit.html.twig', [
            'base' => $base,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="base_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Base $base): Response
    {
        if ($this->isCsrfTokenValid('delete'.$base->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($base);
            $entityManager->flush();
        }

        return $this->redirectToRoute('base_index');
    }
}
