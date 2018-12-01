<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\TricksAddResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class TricksAddResponder implements TricksAddResponderInterface
{
    /** @var Environment */
    private $templating;

    /**
     * TricksAddResponder constructor.
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    ) {
        $this->templating = $templating;
    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function response(): Response
    {
        return new Response(
            $this->templating->render(
                'tricks_add.html.twig'
            )
        );
    }
}
