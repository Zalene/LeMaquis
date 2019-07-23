<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArtisteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 6; $i++) {
            $artiste = new Artiste();
            $artiste->setName("Artiste n°$i")
                    ->setBio("Biographie de l'artiste n°$i")
                    ->setImage("http://placehold.it/350x150");

            $manager->persist($artiste);
        }

        $manager->flush();
    }
}
