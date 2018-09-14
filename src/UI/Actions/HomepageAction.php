<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\HomepageActionInterface;
use App\UI\Responders\Interfaces\HomepageResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageAction implements HomepageActionInterface
{
    private $responder;

    /**
     * HomepageAction constructor.
     * @param HomepageResponderInterface $responder
     */
    public function __construct(
        HomepageResponderInterface $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function action(): Response
    {
        return $this->responder->response();
    }
}
