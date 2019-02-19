<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Commands;

use App\Domain\Models\FigureGroup;
use App\Domain\Models\TypeMedia;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFieldCommand extends Command
{
    // the name of the command (the part after "bin/console")
    /** @var string */
    protected static $defaultName = 'app:create-field';
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * CreateFieldCommand constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new field passed in parameter.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a field in the corresponding entity with corrects parameters (except the id) :\nExemple : '.CreateFieldCommand::$defaultName.' user theUsername theEmail thePasswordNotEncrypted')
            ->addArgument(
                "entity",
                InputArgument::REQUIRED,
                "The entity where you want to create a new field.",
                null
            )
            ->addArgument(
                "field",
                InputArgument::REQUIRED,
                "The field you want.",
                null
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entities = [
          "type_media",
          "figure_group",
          "user",
          "trick",
          "media",
          "comment",
        ];

        $error = null;

        switch ($input->getArgument("entity")) {
            case $entities[0]:
                $model = new TypeMedia($input->getArgument("field"));
                break;
            case $entities[1]:
                $model = new FigureGroup($input->getArgument("field"));
                break;
            default:
                $error = "This entity does not exist or is not provided for in this command.";
        }

        if ($error != null) {
            $output->writeln($error);
        } else {
            $this->entityManager->persist($model);
            $this->entityManager->flush();
            $output->writeln("(+) The new field of the entity '".$input->getArgument("entity")."' has been created.");
        }
    }
}
