<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\DataFixtures;

use App\Domain\Models\TypeMedia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeMediaFixture extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager)
    {
        $image = new TypeMedia("image");
        $video = new TypeMedia("video");

        $manager->persist($image);
        $manager->persist($video);
        $manager->flush();
    }
}
