<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pokemon as PokemonEntity;
use App\Entity\Type as TypeEntity;

class PokemonFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $pokemons = [
            [
                'nom' => 'carapuce',
                'type' => 'eau'
            ],
            [
                'nom' => 'salameche',
                'type' => 'feu'
            ],
            [
                'nom' => 'bulbizarre',
                'type' => 'plante'
            ],
        ];

        $this->createManyPokemons($pokemons, $manager);

        $manager->flush();
    }

    public function createManyPokemons(array $pokemons, ObjectManager $manager): void
    {
        foreach ($pokemons as $key => $value) {
            $type = new TypeEntity();
            $type->setNom($value['type']);
            $manager->persist($type);

            $this->addReference("Type_".$key, $type);
            
            $pokemon = new PokemonEntity();
            $pokemon
                ->setNom($value['nom'])
                ->settype($this->getReference("Type_".$key))
                ->setPointDeVie(mt_rand(100,300))
                ->setPointAttaque(mt_rand(1,500))
            ;
            $manager->persist($pokemon);
        }
    }
}
