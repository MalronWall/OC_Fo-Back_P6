<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

use App\Application\Helpers\Interfaces\MailerHelperInterface;
use Swift_Mailer;
use Twig\Environment;

class MailerHelper implements MailerHelperInterface
{
    /** @var Swift_Mailer */
    private $mailer;
    /** @var Environment */
    private $templating;

    /**
     * MailerHelper constructor.
     * @param Swift_Mailer $mailer
     * @param Environment $templating
     */
    public function __construct(
        Swift_Mailer $mailer,
        Environment $templating
    ) {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param $subject
     * @param $from
     * @param $to
     * @param $user
     * @return int
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendEmail($subject, $from, $to, $user)
    {
        /** @var \Swift_Message $message */
        $message = $this->mailer->createMessage();
        $message
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody(
                $this->templating->render(
                    'emails/forgot_password.html.twig',
                    [
                        "user" => $user
                    ]
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/registration.txt.twig',
                    ['name' => $name]
                ),
                'text/plain'
            )
            */
        ;

        return $this->mailer->send($message);
    }
}
