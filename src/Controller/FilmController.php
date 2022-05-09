<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(FilmRepository $repo): Response
    {
        $films = $repo->findAll();

        return $this->render('home/index.html.twig', [
            'films' => $films,
        ]);
    }

    #[Route('/film/{id}', name: 'film_detail')]
    public function filmDetail($id, FilmRepository $repo)
    {
        $film = $repo->find($id);

        return $this->render('film/detail.html.twig', ['film' => $film]);
    }
}
