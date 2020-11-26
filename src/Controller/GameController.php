<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game/{id<\d+>}", name="game")
     */
    public function index(Game $game)
    {
        return $this->render('game/details.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/game/add", name="game_add")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function gameForm(Request $request, EntityManagerInterface $manager)
    {
//        if( ! $this->isGranted('IS_AUTHENTICATED_FULLY')) {
//            throw $this->createAccessDeniedException(); // Erreur 403
//        }
        $game = new Game();
        $gameForm = $this->createForm(GameType::class, $game);

        $gameForm->handleRequest($request);

        if($gameForm->isSubmitted() && $gameForm->isValid()) {
            /** @var UploadedFile $imageFile */

            $imageFile = $gameForm->get('imageFile')->getData();

            // move_uploaded_file($_FILES['imageFile']['tmp_name'], 'game-images');
            $filename = md5(uniqid()) . '.' . $imageFile->guessExtension();
            $imageFile->move('game-images', $filename);
            $game->setImage('game-images/'.$filename);
            $game->setUser($this->getUser());
            $manager->persist($game);
            $manager->flush();
            return $this->redirectToRoute('user', [
                'id' => $this->getUser()->getId()
            ]);
        }

        return $this->render('game/form.html.twig', [
            'game_form' => $gameForm->createView()
        ]);
    }

    /**
     * @Route("/game/search", name="game_search")
     */
    public function searchGame(Request $request, GameRepository $gameRepository)
    {
        $q = $request->get('q');
        // dd($q);  dump and die
        $results = $gameRepository->searchGame($q);

        return $this->render('game/search-game.html.twig', [
           'search' => $q,
           'results' => $results
        ]);
    }
}
