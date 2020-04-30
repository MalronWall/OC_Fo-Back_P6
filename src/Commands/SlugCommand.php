<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Commands;

use App\Application\Helpers\SafeRenameHelper;
use App\Domain\Models\FigureGroup;
use App\Domain\Models\Trick;
use App\Domain\Models\TypeMedia;
use App\Domain\Models\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class SlugCommand extends Command
{
    // https://github.com/nelmio/alice =>

    // the name of the command (the part after "bin/console")
    /** @var string */
    protected static $defaultName = 'app:slug';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Convert a text in a slug convention.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("This command allows you to convert a string or text into a slug that can be used without ".
                "worry in an url for example :\nExample : php bin/console ".SlugCommand::$defaultName.
                " The text, with some extra characters '%^-\", you want to convert in a slug...\n".
                "Resultat : the-text-with-some-extra-characters-you-want-to-convert-in-a-slug")
            ->addArgument(
                "text",
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                "The text you want to convert.",
                null
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $slug = SafeRenameHelper::slug(implode(" ", $input->getArgument("text")));

        $output->writeln("[SLUG] $slug");
    }
}
