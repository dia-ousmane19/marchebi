<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnnoncesRepository;

class UserAccountController extends AbstractController
{
    /**
     * @Route("/mon-compte", name="user_account")
     */
    public function index(AnnoncesRepository $annoncesRepository)
    {
      $user=$this->getUser();
       // annonce en expirer
      $users=$annoncesRepository->findAllAnnoncesByUserExpirer($user->getId());
      // annonce en ligne
      $usersEnLigne=$annoncesRepository->findAllAnnonceEnLigne($user->getId());


        return $this->render('user_account/index.html.twig',[
          'users'=> $users,
          'user' =>$user,
          'usersEnLigne'=>$usersEnLigne
        ]);
    }
}
