<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Tests\UI\Actions;

use App\Application\Handlers\Forms\ForgotPasswordHandler;
use App\Application\Helpers\MailerHelper;
use App\Domain\Repository\UserRepository;
use App\UI\Actions\ForgotPasswordAction;
use App\UI\Forms\ForgotPasswordType;
use App\UI\Responders\ForgotPasswordResponder;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Twig\Environment;

class ForgotPasswordActionTest extends TestCase
{
    /** @var ForgotPasswordAction */
    private $action;
    /** @var ForgotPasswordHandler */
    private $formHandler;
    /** @var UserRepository|MockObject */
    private $repository;
    /** @var Form|MockObject */
    private $form;

    public function setUp()
    {
        /** @var Environment|MockObject $templating */
        $templating = $this->createMock(Environment::class);
        $templating->method("render")->willReturn("Vue HTML");

        /** @var UrlGenerator|MockObject $urlGenerator */
        $urlGenerator = $this->createMock(UrlGenerator::class);
        $urlGenerator->method("generate")->willReturn("URL");

        $responder = new ForgotPasswordResponder($templating, $urlGenerator);

        /** @var FormFactory|MockObject $formFactory */
        $formFactory = $this->createMock(FormFactory::class);

        $this->form = $this->createMock(ForgotPasswordType::class);
        $formFactory->method("create")->willReturn($this->form);

        $request = $this->createMock(Request::class);
        $this->form->method("handleRequest")->willReturn($request);

        /** @var UserRepository|MockObject repository */
        $this->repository = $this->createMock(UserRepository::class);

        /** @var EntityManager|MockObject $entityManager */
        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->method("getRepository")->willReturn($this->repository);

        /** @var Session|MockObject $session */
        $session = $this->createMock(Session::class);

        /** @var UriSafeTokenGenerator|MockObject $tokenGenerator */
        $tokenGenerator = $this->createMock(UriSafeTokenGenerator::class);

        // TODO MailerHelper à tester
        /** @var MailerHelper|MockObject $mailerHelper */
        $mailerHelper = $this->createMock(MailerHelper::class);


        $this->formHandler = new ForgotPasswordHandler($entityManager, $session, $tokenGenerator, $mailerHelper);

        $this->action = new ForgotPasswordAction($responder, $formFactory, $this->formHandler);
    }

    public function testIfFormIsNotSubmittedThenReturnResponseWithForm()
    {
        $this->form->method("isSubmitted")->willReturn(false);

        $response = $this->action->action(new Request());

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }


















}
