<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Tests\UI\Actions;

use App\Application\Helpers\PaginatorHelper;
use App\Domain\Repository\CommentRepository;
use App\UI\Actions\AjaxTricksDetailsAction;
use App\UI\Responders\AjaxTricksDetailsResponder;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AjaxTricksDetailsActionTest extends TestCase
{
    /** @var AjaxTricksDetailsAction */
    private $action;
    /** @var CommentRepository|MockObject */
    private $repository;
    /** @var PaginatorHelper|MockObject */
    private $paginatorHelper;

    public function setUp()
    {
        /** @var Environment|MockObject $templating */
        $templating = $this->createMock(Environment::class);
        $templating->method("render")->willReturn("Vue HTML");

        $responder = new AjaxTricksDetailsResponder($templating);

        /** @var CommentRepository|MockObject $repository */
        $this->repository = $this->createMock(CommentRepository::class);
        $this->repository->method("getCommentsFrom")->willReturn(["Some Comments"]);

        /** @var EntityManager|MockObject $entityManager */
        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->method("getRepository")->willReturn($this->repository);

        $this->paginatorHelper = $this->createMock(PaginatorHelper::class);

        $this->action = new AjaxTricksDetailsAction($responder, $entityManager, $this->paginatorHelper);
    }

    public function testIfPaginatorReturnNull()
    {
        $this->paginatorHelper->method("nbPagesTot")->willReturn(null);

        $response = $this->action->action("slug", 2);

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testIfPaginatorReturnNumber()
    {
        $this->paginatorHelper->method("nbPagesTot")->willReturn(1);

        $response = $this->action->action("slug", 2);

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
