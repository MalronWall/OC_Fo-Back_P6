<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\TricksAddActionInterface;
use App\UI\Responders\Interfaces\TricksAddResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksAddAction implements TricksAddActionInterface
{
    private $responder;

    /**
     * TricksAddAction constructor.
     * @param TricksAddResponderInterface $responder
     */
    public function __construct(
        TricksAddResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/tricks/add/", name="tricks_add")
     * @return mixed
     */
    public function action():Response
    {
        return $this->responder->response();
    }
}
