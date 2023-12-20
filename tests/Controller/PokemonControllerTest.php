<?php

namespace App\Test\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PokemonControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/pokemon/';

    
    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Pokemon::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush(); 
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Pokemon index');

    } 

    public function testNew(): void
    {
        
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'pokemon[nom]' => 'Testing34', // Données différentes ici
            'pokemon[point_de_vie]' => '30', // Autres valeurs différentes pour des tests distincts
            'pokemon[point_attaque]' => '30',
            'pokemon[type]' => '7',
        ]);

    }

    /*public function testDeletePokemon(): void
    {
        // demande POST pour supprimer le Pokémon avec l'ID 34
        $this->client->request('POST', '/pokemon/34', ['_token' => '5ff2883706ad8cffd69faa85.11P9XrUUYHbf76zLmDx0-vLxzOdMWqZy0j6hTSvcbnw.5wqRMoZ2IUW5pJ-68UgMtKC3m4wfbf8hlEnZfnKUNB-UYasV0m43D4669Q']);

        // Vérification si la réponse est une redirection après la suppression
        self::assertResponseRedirects('/');

        // Vérification que le Pokémon avec l'ID 34 a été correctement supprimé de la base de données
        $entityManager = $this->client->getContainer()->get('doctrine')->getManager();
        $deletedPokemon = $entityManager->getRepository(Pokemon::class)->find(34); // Adapter la méthode pour trouver un Pokémon par son ID

        self::assertNull($deletedPokemon); // Le Pokémon n'est plus trouvé, donc il a été supprimé
    }*/


/*    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Pokemon();
        $fixture->setNom('My Title');
        $fixture->setPoint_de_vie('My Title');
        $fixture->setPoint_attaque('My Title');
        $fixture->setType('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Pokemon');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Pokemon();
        $fixture->setNom('Value');
        $fixture->setPoint_de_vie('Value');
        $fixture->setPoint_attaque('Value');
        $fixture->setType('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'pokemon[nom]' => 'Something New',
            'pokemon[point_de_vie]' => 'Something New',
            'pokemon[point_attaque]' => 'Something New',
            'pokemon[type]' => 'Something New',
        ]);

        self::assertResponseRedirects('/pokemon/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPoint_de_vie());
        self::assertSame('Something New', $fixture[0]->getPoint_attaque());
        self::assertSame('Something New', $fixture[0]->getType());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Pokemon();
        $fixture->setNom('Value');
        $fixture->setPoint_de_vie('Value');
        $fixture->setPoint_attaque('Value');
        $fixture->setType('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/pokemon/');
        self::assertSame(0, $this->repository->count([]));
    }*/
}
