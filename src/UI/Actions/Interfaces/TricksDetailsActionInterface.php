<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\TricksDetailsResponderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

interface TricksDetailsActionInterface
{
    /**
     * TricksDetailsActionInterface constructor.
     * @param TricksDetailsResponderInterface $responder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        TricksDetailsResponderInterface $responder,
        EntityManagerInterface $entityManager
    );

    /**
     * @param $slug
     * @return Response
     */
    public function action($slug):Response;
}
