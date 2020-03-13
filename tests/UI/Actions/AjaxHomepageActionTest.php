<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Tests\UI\Actions;

use App\Application\Helpers\PaginatorHelper;
use App\Domain\Repository\TrickRepository;
use App\UI\Actions\AjaxHomepageAction;
use App\UI\Responders\AjaxHomepageResponder;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AjaxHomepageActionTest extends TestCase
{
    /** @var AjaxHomepageAction */
    private $action;
    /** @var TrickRepository|MockObject */
    private $repository;

    public function setUp()
    {
        /** @var Environment|MockObject $templating */
        $templating = $this->createMock(Environment::class);
        $templating->method("render")->willReturn("Vue HTML");

        $responder = new AjaxHomepageResponder($templating);

        /** @var TrickRepository|MockObject $repository */
        $this->repository = $this->createMock(TrickRepository::class);
        $this->repository->method("getTricksFrom")->willReturn(["Some Tricks"]);

        /** @var EntityManager|MockObject $entityManager */
        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->method("getRepository")->willReturn($this->repository);

        $paginatorHelper = new PaginatorHelper();

        $this->action = new AjaxHomepageAction($responder, $entityManager, $paginatorHelper);
    }

    public function testIfNumPageEqualZeroThenNbPagesTotIsNull()
    {
        $this->repository->method("nbEntities")->willReturn(10);

        $response = $this->action->action(0);

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testIfNumPageIsSuperiorThanNbPagesTotThenNbPagesTotIsNull()
    {
        $this->repository->method("nbEntities")->willReturn(10);

        $response = $this->action->action(2);

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testIfNbPagesTotEqual0ThenNbPagesTotIsNull()
    {
        $this->repository->method("nbEntities")->willReturn(0);

        $response = $this->action->action(2);

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testIfNbPagesTotIsSuperiorThan0AndNumPageIsBetween0AndNbPagesTotThenTricksReturned()
    {
        $this->repository->method("nbEntities")->willReturn(15);

        $response = $this->action->action(2);

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
