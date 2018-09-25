<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class LoginResponder implements LoginResponderInterface
{
    /** @var Environment */
    private $templating;

    /**
     * LoginResponder constructor.
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
                'login.html.twig'
            )
        );
    }
}
