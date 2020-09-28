<?php

namespace App\Controller;

use App\Entity\Memo;
use App\Form\MemoType;
use App\Repository\BaseRepository;
use App\Repository\MemoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/memo")
 */
class MemoController extends AbstractController
{
    /**
     * @Route("/", name="memo_index", methods={"GET"})
     */
    public function index(MemoRepository $memoRepository, BaseRepository $baseRepository): Response
    {
        return $this->render('memo/index.html.twig', [
            'memos' => $memoRepository->findAll(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),

        ]);
    }

    /**
     * @Route("/new", name="memo_new", methods={"GET","POST"})
     */
    public function new(Request $request, BaseRepository $baseRepository): Response
    {
        $memo = new Memo();
        $memo->setUser($this->getUser());
        $memo->setUpdatedAt(new\DateTime('now'));
        $form = $this->createForm(MemoType::class, $memo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($memo);
            $entityManager->flush();

            return $this->redirectToRoute('memo_index');
        }

        return $this->render('memo/new.html.twig', [
            'memo' => $memo,
            'form' => $form->createView(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }

    /**
     * @Route("/{id}", name="memo_show", methods={"GET"})
     */
    public function show(Memo $memo, BaseRepository $baseRepository): Response
    {
        return $this->render('memo/show.html.twig', [
            'memo' => $memo,
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="memo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Memo $memo, BaseRepository $baseRepository): Response
    {
        $memo->setUser($this->getUser());
        $memo->setUpdatedAt(new\DateTime('now'));
        $form = $this->createForm(MemoType::class, $memo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('memo_index');
        }

        return $this->render('memo/edit.html.twig', [
            'memo' => $memo,
            'form' => $form->createView(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }

    /**
     * @Route("/{id}", name="memo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Memo $memo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$memo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($memo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('memo_index');
    }
}
