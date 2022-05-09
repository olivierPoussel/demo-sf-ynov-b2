<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use App\Entity\Film;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $acteurs = [];
        for ($i = 0; $i < 20; $i++) {
            $acteur = new Acteur();
            $acteur
                ->setNom('nom' . $i)
                ->setPrenom('prenom' . $i);

            $manager->persist($acteur);
            $manager->flush();
            array_push($acteurs, $acteur);
        }

        for ($j = 0; $j < 10; $j++) {
            $film = new Film();
            $film->setTitle('title' . $j)
                ->setDuree(random_int(100, 240));
            $manager->persist($film);
            $manager->flush();
            $nbActeur = random_int(1, 4);
            for ($k = 0; $k < $nbActeur; $k++) {
                $role = new Role();
                $role->setName('role ' . $k)
                    ->setFilm($film)
                    ->setActeur($acteurs[random_int(0, count($acteurs) - 1)]);
                $manager->persist($role);
            }
            $manager->flush();
        }



        // $manager->flush();
    }
}
