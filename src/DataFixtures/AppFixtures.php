<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $acteur = new Acteur();
            $acteur
                ->setNom('nom' . $i)
                ->setPrenom('prenom' . $i);

            $manager->persist($acteur);
            $manager->flush();
        }

        // $manager->flush();
    }
}
