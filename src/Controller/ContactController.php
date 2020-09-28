<?php

namespace App\Controller;

use App\Entity\Base;
use App\Form\ContactType;
use App\Repository\BaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer, BaseRepository $baseRepository)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() &&$form->isValid()){

            $contactFormData = $form->getData();

            $message = (new \Swift_Message('ContactFormulier'))
                ->setFrom($contactFormData['email'])
                ->setTo('wesleyvanrijn02@gmail.com')
                ->setBody(
                    $contactFormData['message'], 'text/plain'
                );

            $mailer->send($message);

        }

        return $this ->render('contact/index.html.twig', [
            'our_form' => $form->createView(),
            'logo' => $baseRepository->findOneBy([],[])->getLogo(),
        ]);
    }
}
