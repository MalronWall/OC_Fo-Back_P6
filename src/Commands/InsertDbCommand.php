<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\Commands;

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

class InsertDbCommand extends Command
{
    // https://github.com/nelmio/alice =>

    // the name of the command (the part after "bin/console")
    /** @var string */
    protected static $defaultName = 'app:insert-db';
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var EncoderFactoryInterface */
    private $passwordEncoder;

    /**
     * InsertDbCommand constructor.
     * @param EntityManagerInterface $entityManager
     * @param EncoderFactoryInterface $passwordEncoder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EncoderFactoryInterface $passwordEncoder
    ) {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new field passed in parameter.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a field in the corresponding entity with corrects parameters (except the id) :\nExemple : '.InsertDbCommand::$defaultName.' user theUsername theEmail thePasswordNotEncrypted')
            ->addArgument(
                "entity",
                InputArgument::REQUIRED,
                "The entity where you want to create a new field.",
                null
            )
            ->addArgument(
                "fields",
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                "The fields you want.",
                null
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $error = null;

        switch ($input->getArgument("entity")) {
            case "type_media":
                $model = new TypeMedia($input->getArgument("fields")[0]);
                break;
            case "figure_group":
                $model = new FigureGroup($input->getArgument("fields")[0]);
                break;
            case "user":
                $pwdEncoder = $this->passwordEncoder->getEncoder(User::class);
                $pwdEncoded = $pwdEncoder->encodePassword($input->getArgument("fields")[2], '');
                $model = new User(
                    $input->getArgument("fields")[0],
                    $input->getArgument("fields")[1],
                    $pwdEncoded
                );
                break;
            default:
                $error = "This entity does not exist or is not provided for in this command.";
        }

        if ($error != null) {
            $output->writeln($error);
        } elseif ($model != null) {
            $this->entityManager->persist($model);
            $this->entityManager->flush();
            $output->writeln("(+) The new field of the entity '".$input->getArgument("entity")."' has been created.");
        } else {
            $output->writeln("[ERROR] An error occured: please check the command code.");
        }
    }
}
