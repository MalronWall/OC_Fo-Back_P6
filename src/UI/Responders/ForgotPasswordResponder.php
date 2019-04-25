<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\ForgotPasswordResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ForgotPasswordResponder implements ForgotPasswordResponderInterface
{
    /** @var Environment */
    private $templating;
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /**
     * ForgotPasswordResponder constructor.
     * @param Environment $templating
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $templating,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->templating = $templating;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param bool $isRedirect
     * @param FormInterface $form
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function response(bool $isRedirect, FormInterface $form = null):Response
    {
        return $isRedirect ?
            new RedirectResponse(
                $this->urlGenerator->generate('homepage')
            ):
            new Response(
                $this->templating->render(
                    'forgot_password.html.twig',
                    [
                        'form' => $form->createView()
                    ]
                )
            );
    }
}
