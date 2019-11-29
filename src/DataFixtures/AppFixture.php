<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\DataFixtures;

use App\Domain\Models\FigureGroup;
use App\Domain\Models\Trick;
use App\Domain\Models\TypeMedia;
use App\Domain\Models\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use function Sodium\add;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixture extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * AppFixture constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager)
    {
        // USER
        $user1 = new User("JohnDoe", "johndoe@gmail.com", "bla");
        $password = $this->passwordEncoder->encodePassword($user1, "password");
        $user1->resetPwd($password);

        $manager->persist($user1);

        $user2 = new User("JaneDoe", "janedoe@gmail.com", "bla");
        $password = $this->passwordEncoder->encodePassword($user2, "password");
        $user2->resetPwd($password);

        $manager->persist($user2);

        // FIGURE GROUP
        $grabs = new FigureGroup("Grabs");
        $rotations = new FigureGroup("Rotations");
        $flips = new FigureGroup("Flips");

        $manager->persist($grabs);
        $manager->persist($rotations);
        $manager->persist($flips);

        // TYPE MEDIA
        $image = new TypeMedia("image");
        $video = new TypeMedia("video");

        $manager->persist($image);
        $manager->persist($video);
        $manager->flush();

        // TRICK
        $mute = new Trick(
            $user1,
            "Mute",
            "Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.",
            $grabs
        );
        $sade = new Trick(
            $user2,
            "Sade",
            "Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.",
            $grabs
        );
        $indy = new Trick(
            $user1,
            "Indy",
            "Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.",
            $grabs
        );
        $stalefish = new Trick(
            $user2,
            "Stalefish",
            "Saisie de la carre backside de la planche entre les deux pieds avec la main arrière.",
            $grabs
        );
        $tailGrab = new Trick(
            $user1,
            "Tail Grab",
            "Saisie de la partie arrière de la planche, avec la main arrière.",
            $grabs
        );
        $noseGrab = new Trick(
            $user2,
            "Nose Grab",
            "Saisie de la partie avant de la planche, avec la main avant.",
            $grabs
        );
        $r180 = new Trick(
            $user1,
            "180°",
            "Rotation de la planche à 180°.",
            $rotations
        );
        $r360 = new Trick(
            $user2,
            "360°",
            "Rotation de la planche à 360°.",
            $rotations
        );
        $r540 = new Trick(
            $user1,
            "540°",
            "Rotation de la planche à 540°.",
            $rotations
        );
        $r720 = new Trick(
            $user2,
            "720°",
            "Rotation de la planche à 720°.",
            $rotations
        );
        $r900 = new Trick(
            $user1,
            "900°",
            "Rotation de la planche à 900°.",
            $rotations
        );
        $r1080 = new Trick(
            $user2,
            "1080°",
            "Rotation de la planche à 1080°.",
            $rotations
        );
        $frontFlip = new Trick(
            $user1,
            "Front Flip",
            "Rotation verticale de la planche en partant vers l'avant.",
            $flips
        );
        $backFlip = new Trick(
            $user2,
            "Back Flip",
            "Rotation verticale de la planche en partant vers l'arrière.",
            $flips
        );

        $manager->persist($mute);
        $manager->persist($sade);
        $manager->persist($indy);
        $manager->persist($stalefish);
        $manager->persist($tailGrab);
        $manager->persist($noseGrab);

        $manager->persist($r180);
        $manager->persist($r360);
        $manager->persist($r540);
        $manager->persist($r720);
        $manager->persist($r900);
        $manager->persist($r1080);

        $manager->persist($frontFlip);
        $manager->persist($backFlip);

        // MEDIA
        // TODO MediaFixtures

        $manager->flush();
    }
}
