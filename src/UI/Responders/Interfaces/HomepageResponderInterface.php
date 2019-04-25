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
     * @param array $tricks
     * @param int $nbPageTot
     * @return Response
     */
    public function response(array $tricks, int $nbPageTot = 1): Response;
}
