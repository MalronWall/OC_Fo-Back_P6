<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\HomepageResponderInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomepageResponder implements HomepageResponderInterface
{
    /** @var Environment */
    private $templating;

    /**
     * HomepageResponder constructor.
     * @param Environment $templating
     */
    public function __construct(
        Environment $templating
    ) {
        $this->templating = $templating;
    }

    /**
     * @param array $tricks
     * @param int $nbPagesTot
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(array $tricks, int $nbPagesTot = 1): Response
    {
        return new Response(
            $this->templating->render(
                'homepage.html.twig',
                [
                    "tricks" => $tricks,
                    "nbPagesTot" => $nbPagesTot
                ]
            )
        );
    }
}
