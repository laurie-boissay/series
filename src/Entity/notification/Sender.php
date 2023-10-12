<?php

namespace App\Entity\notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\Headers; // Assurez-vous d'importer correctement la classe Headers

class Sender
{
    public function __construct(protected MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewUserNotificationToAdmin(UserInterface $user): void
    {
        // Créez un objet Email
        $message = (new Email())
            ->from('acounts@series.com')
            ->to('admin@series.com')
            ->subject('New account created on series.com')
            ->text('New account! Email: ' . $user->getEmail()); // Utilisez la méthode text pour le corps de l'e-mail

        $this->mailer->send($message);
    }
}
