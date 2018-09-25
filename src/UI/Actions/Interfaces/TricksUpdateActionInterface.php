<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\TricksUpdateResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface TricksUpdateActionInterface
{
    /**
     * TricksUpdateActionInterface constructor.
     * @param TricksUpdateResponderInterface $responder
     */
    public function __construct(
        TricksUpdateResponderInterface $responder
    );

    /**
     * @param $slug
     * @return Response
     */
    public function action($slug):Response;
}
