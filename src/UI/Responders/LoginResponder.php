<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Twig\Environment;

class LoginResponder implements LoginResponderInterface
{
    /** @var Environment */
    private $templating;
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /**
     * LoginResponder constructor.
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
     * @param FormInterface|null $form
     * @param AuthenticationException|null $authenError
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function response(
        bool $isRedirect,
        FormInterface $form = null,
        AuthenticationException $authenError = null
    ): Response {
        return $isRedirect ?
            new RedirectResponse(
                $this->urlGenerator->generate('homepage')
            ):
            new Response(
                $this->templating->render(
                    'login.html.twig',
                    [
                        'form' => $form->createView(),
                        'error' => $authenError
                    ]
                )
            );
    }
}
