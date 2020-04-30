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

class UniqueFilenameCommand extends Command
{
    // https://github.com/nelmio/alice =>

    // the name of the command (the part after "bin/console")
    /** @var string */
    protected static $defaultName = 'app:unique-filename';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Generate an unique filename.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("This command allows you to generate an unique filename of 32 characteres for an image ".
                "upload or for an article for example :\nExample : php bin/console ".
                UniqueFilenameCommand::$defaultName.
                "\nResultat (example) : 4a73c77d50c353d6601f515bad67fd63")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $uFilename = SafeRenameHelper::uniqueFilename();

        $output->writeln("[U-FILENAME] $uFilename");
    }
}
