<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user")
     */
    public function index(User $user /*, GameRepository $gameRepository*/)
    {
        /*$userGames = $gameRepository->findBy(['user' => $user]);*/
        return $this->render('user/profile.html.twig', [
            'user' => $user,
            /* 'userGames' => $userGames */
        ]);
    }

//    public function index($id, UserRepository $userRepository)
//    {
//        // $pdo->query('select * from user where id = :id')->fetch()
//        $user = $userRepository->find($id);
//        if($user === null) {
//            // pas d'utilisateur : erreur 404
//            throw $this->createNotFoundException('Aucun utilisateur trouvé');
//        }
//        return $this->render('user/profile.html.twig', [
//            'user' => $user,
//        ]);
//    }

//    public function index(Request $request, UserRepository $userRepository)
//    {
//        $id = $request->get('id');
//        // $pdo->query('select * from user where id = :id')->fetch()
//        $user = $userRepository->find($id);
//        if($user === null) {
//            // pas d'utilisateur : erreur 404
//            throw $this->createNotFoundException('Aucun utilisateur trouvé');
//        }
//        return $this->render('user/profile.html.twig', [
//            'user' => $user,
//        ]);
//    }
}
