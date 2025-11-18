<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:update-admin-roles',
    description: 'Ajoute tous les rôles à l\'administrateur'
)]
class UpdateAdminRolesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $admin = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'admin@ideal2.com']);

        if (!$admin) {
            $output->writeln("<error>Administrateur non trouvé !</error>");
            return Command::FAILURE;
        }

        // Donner TOUS les rôles à l'admin
        $admin->setRoles([
            'ROLE_ADMIN',
            'ROLE_RH',
            'ROLE_MEDICAL',
            'ROLE_USER',
            'ROLE_SUPER_ADMIN'
        ]);

        $this->entityManager->flush();

        $output->writeln("<info>Rôles de l'administrateur mis à jour avec succès !</info>");
        $output->writeln("Rôles actuels: " . implode(', ', $admin->getRoles()));

        return Command::SUCCESS;
    }
}
