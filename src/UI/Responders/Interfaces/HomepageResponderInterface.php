<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders\Interfaces;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface HomepageResponderInterface
{
    /**
     * HomepageResponderInterface constructor.
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    );

    /**
     * @return Response
     */
    public function response(): Response;
}
