<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\TricksDetailsActionInterface;
use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksDetailsAction implements TricksDetailsActionInterface
{
    private $responder;

    /**
     * TricksDetailsAction constructor.
     * @param TricksDetailsResponderInterface $responder
     */
    public function __construct(
        TricksDetailsResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/tricks/details/{slug}/{page}", name="tricks_details", requirements={"slug":".+","page":"\d*"})
     * @param $slug
     * @param int $page
     * @return mixed
     */
    public function action($slug = "test", $page = 1):Response
    {
        return $this->responder->response();
    }
}
