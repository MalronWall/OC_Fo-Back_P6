<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Application\Helpers;

class SafeRenameHelper
{
    /**
     * @param string $string
     * @return string
     */
    public static function slug(string $string): string
    {
        return
            trim(
                strtolower(
                    preg_replace(
                        '~[^0-9a-z]+~i',
                        '-',
                        html_entity_decode(
                            preg_replace(
                                '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i',
                                '$1',
                                htmlentities(
                                    $string,
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ),
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    )
                ),
                '-'
            );
    }

    /**
     * @return string
     */
    public static function uniqueFilename(): string
    {
        return md5(uniqid());
    }
}
