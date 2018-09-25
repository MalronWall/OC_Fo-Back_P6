<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\TricksUpdateActionInterface;
use App\UI\Responders\Interfaces\TricksUpdateResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksUpdateAction implements TricksUpdateActionInterface
{
    private $responder;

    /**
     * TricksUpdateAction constructor.
     * @param TricksUpdateResponderInterface $responder
     */
    public function __construct(
        TricksUpdateResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/tricks/update/{slug}", name="tricks_update", requirements={"slug":".+"})
     * @param $slug
     * @param int $page
     * @return mixed
     */
    public function action($slug = "test", $page = 1):Response
    {
        return $this->responder->response();
    }
}
