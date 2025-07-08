<?php

namespace App\Controller;

use App\Dto\ContactDto;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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
            $email = (new TemplatedEmail())
                ->from($contactDto->email)
                ->to($contactDto->service) // Envoi au service sélectionné
                ->subject('Nouveau message de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact' => $contactDto,
                ]);

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
