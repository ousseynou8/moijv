<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(GameRepository $gameRepository)
    {
        // $pdo->query("SELECT * FROM game")->fetchAll();
        // $games = $gameRepository->findAll();

        // $pdo->query("SELECT * FROM game LEFT JOIN user ON user.id = game.user_id")->fetchAll()
        $games = $gameRepository->getGamesWithUsers();
        return $this->render('home/index.html.twig', [
            'app_name' => 'Moi J\'en veux',
            'list_games' => $games
        ]);
    }

    /**
     * @Route("/", name="root")
     */
    public function root()
    {
        return $this->redirectToRoute('home');
    }
}
