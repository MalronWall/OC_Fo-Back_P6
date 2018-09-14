<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\HomepageResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface HomepageActionInterface
{
    /**
     * HomepageActionInterface constructor.
     * @param HomepageResponderInterface $responder
     */
    public function __construct(
        HomepageResponderInterface $responder
    );

    /**
     * @return Response
     */
    public function action(): Response;
}
