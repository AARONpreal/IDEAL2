<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Service;
use App\Entity\Fonction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des départements
        $departementsData = [
            'Ressources Humaines',
            'Informatique',
            'Finance',
            'Marketing',
            'Production',
            'Service Médical'
        ];

        $departements = [];
        foreach ($departementsData as $depName) {
            $departement = new Departement();
            $departement->setNom($depName);
            $manager->persist($departement);
            $departements[] = $departement;
        }

        // Création des services
        $servicesData = [
            ['Informatique', 'Développement'],
            ['Informatique', 'Réseau'],
            ['Informatique', 'Support'],
            ['Finance', 'Comptabilité'],
            ['Finance', 'Trésorerie'],
            ['Marketing', 'Communication'],
            ['Marketing', 'Publicité'],
            ['Production', 'Manufacturing'],
            ['Production', 'Qualité'],
            ['Ressources Humaines', 'Recrutement'],
            ['Ressources Humaines', 'Formation'],
            ['Service Médical', 'Médecine du travail'],
            ['Service Médical', 'Infirmier']
        ];

        $services = [];
        foreach ($servicesData as [$depName, $serviceName]) {
            $service = new Service();
            $service->setNom($serviceName);

            // Trouver le département correspondant
            foreach ($departements as $dep) {
                if ($dep->getNom() === $depName) {
                    $service->setDepartement($dep);
                    break;
                }
            }

            $manager->persist($service);
            $services[] = $service;
        }

        // Création des fonctions
        $fonctionsData = [
            'Développeur Full Stack',
            'Administrateur Réseau',
            'Technicien Support',
            'Comptable',
            'Chef Comptable',
            'Trésorier',
            'Responsable Marketing',
            'Chargé de Communication',
            'Agent de Production',
            'Technicien Qualité',
            'Responsable RH',
            'Spécialiste Recrutement',
            'Coordinateur Formation',
            'Médecin du Travail',
            'Infirmier',
            'Directeur'
        ];

        foreach ($fonctionsData as $fonctionName) {
            $fonction = new Fonction();
            $fonction->setNom($fonctionName);
            $manager->persist($fonction);
        }

        $manager->flush();
    }
}
