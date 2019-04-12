<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\MediasTricksDeleteResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MediasTricksDeleteResponder implements MediasTricksDeleteResponderInterface
{
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param $slug
     * @return Response
     */
    public function response($slug): Response
    {
        return
            new RedirectResponse(
                $this->urlGenerator->generate(
                    'tricks_update',
                    [
                        $slug
                    ]
                )
            );
    }
}
