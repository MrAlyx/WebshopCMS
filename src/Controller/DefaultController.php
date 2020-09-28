<?php

namespace App\Controller;

use App\Repository\BaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(BaseRepository $baseRepository)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'bedrijf' => $baseRepository->findOneBy([],[])->getBedrijfsnaam(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }

}
