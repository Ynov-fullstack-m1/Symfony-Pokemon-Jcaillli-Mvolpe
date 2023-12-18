<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'app_pokemon')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        // Récupère tous les Pokémon à partir du repository
        $allPokemon = $pokemonRepository->findAll();
        

        return $this->render('pokemon/index.html.twig', [
            'allPokemon' => $allPokemon,
        ]);
    }
}
