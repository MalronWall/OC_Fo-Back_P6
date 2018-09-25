<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Symfony\Component\HttpFoundation\Response;

interface TricksDetailsActionInterface
{
    /**
     * TricksDetailsActionInterface constructor.
     * @param TricksDetailsResponderInterface $responder
     */
    public function __construct(
        TricksDetailsResponderInterface $responder
    );

    /**
     * @param $slug
     * @param int $page
     * @return Response
     */
    public function action($slug, $page = 1):Response;
}
