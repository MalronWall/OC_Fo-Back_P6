<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders\Interfaces;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface AjaxHomepageResponderInterface
{
    /**
     * HomepageResponder constructor.
     * @param Environment $templating
     */
    public function __construct(Environment $templating);

    /**
     * @param array $tricks
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(array $tricks = []): Response;
}