<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\TricksAddResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface TricksAddActionInterface
{
    /**
     * TricksAddActionInterface constructor.
     * @param TricksAddResponderInterface $responder
     */
    public function __construct(
        TricksAddResponderInterface $responder
    );

    /**
     * @return Response
     */
    public function action():Response;
}
