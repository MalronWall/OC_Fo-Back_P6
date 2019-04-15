<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface TricksDetailsResponderInterface
{
    /**
     * TricksDetailsResponderInterface constructor.
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    );

    /**
     * @param $trick
     * @param $comments
     * @param FormInterface|null $form
     * @return Response
     */
    public function response($trick, $comments, FormInterface $form = null): Response;
}
