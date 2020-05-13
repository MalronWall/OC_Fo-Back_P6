<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers\Interfaces;

use Swift_Mailer;
use Twig\Environment;

interface MailerHelperInterface
{
    /**
     * MailerHelper constructor.
     * @param Swift_Mailer $mailer
     * @param Environment $templating
     */
    public function __construct(Swift_Mailer $mailer, Environment $templating);

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
    public function sendEmail($subject, $from, $to, $user);
}
