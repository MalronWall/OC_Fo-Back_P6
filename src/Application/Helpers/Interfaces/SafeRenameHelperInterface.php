<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers\Interfaces;

interface SafeRenameHelperInterface
{
    /**
     * @param string $string
     * @return string
     */
    public function slug(string $string): string;

    /**
     * @return string
     */
    public function uniqueFilename(): string;
}