<?php

namespace App\Controller;

use App\Dto\ContactDto;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contactDto = new ContactDto();
        $form = $this->createForm(ContactType::class, $contactDto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Création de l'email
            $email = (new Email())
                ->from($contactDto->email)
                ->to('destinataire@exemple.com')
                ->subject('Nouveau message de contact')
                ->text(
                    "Nom : {$contactDto->nom}\n" .
                    "Email : {$contactDto->email}\n\n" .
                    $contactDto->message
                );

            // Envoi de l'email
            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            // Redirection pour éviter le resoumission du formulaire
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
