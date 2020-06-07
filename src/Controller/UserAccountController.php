<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnnoncesRepository;
use Symfony\Component\HttpFoundation\Session\Session;
Use App\Repository\ImagesRepository;


class UserAccountController extends AbstractController
{
  /**
  * @Route("/mon-compte", name="user_account")
  */
  public function index(AnnoncesRepository $annoncesRepository)
  {
    $session= new session();
    foreach ($session->getFlashBag()->get('warning', []) as $message) {
      echo '<div class="flash-warning">'.$message.'</div>';
    }
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
  /**
  *
  * @Route("/image-principale/{idAnnonce}", name="ImagePrincipale")
  */
  public function ImagePrincipale($idAnnonce,ImagesRepository $imagesRepository)
  {

   $MesImages=$imagesRepository->findByImage($idAnnonce);
   

    return $this->render('user_account/choisieImagePrincipale.html.twig',[
      'MesImages' => $MesImages
    ]);
  }






}
