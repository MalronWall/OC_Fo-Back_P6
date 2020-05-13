<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Tests\UI\Actions;

use App\Application\Helpers\PaginatorHelper;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Actions\HomepageAction;
use App\UI\Responders\HomepageResponder;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomepageActionTest extends TestCase
{
    // php bin/phpunit --coverage-html coverage

    public function testReturnResponse()
    {
        /** @var MockObject | Environment $templating */
        $templating = $this->createMock(Environment::class);
        $templating->method('render')->willReturn('string');
        $responder = new HomepageResponder($templating);

        /** @var MockObject | TrickRepositoryInterface $trickRepository */
        $trickRepository = $this->createMock(TrickRepositoryInterface::class);
        $trickRepository->method('getTricksFrom')->willReturn([]);
        $trickRepository->method('nbEntities')->willReturn(3);
        /** @var MockObject | EntityManagerInterface $entityManager */
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->method('getRepository')->willReturn($trickRepository);

        $paginatorHelper = new PaginatorHelper();

        $action = new HomepageAction($responder, $entityManager, $paginatorHelper);

        $response = $action->action();

        self::assertInstanceOf(Response::class, $response);
        self::assertNotInstanceOf(RedirectResponse::class, $response);
    }
}
