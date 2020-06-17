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
  public function index(AnnoncesRepository $annoncesRepository,ImagesRepository $imagesRpo)
  {
    $session= new session();
    foreach ($session->getFlashBag()->get('warning', []) as $message) {
      echo '<div class="flash-warning">'.$message.'</div>';
    }
    $user=$this->getUser();
    // annonce en expirer
    $users=$annoncesRepository->findAllAnnoncesByUserExpirer($user->getId());

    //je recupere id des annonces expirer
    $IdDnnonceExpirer=[];
    foreach ($users as  $value) {
      $IdDnnonceExpirer[]=$value;
    }
      //je recupere id des annonces expirer
      $annonceExpirerAvecUneSeuleImage=[];
      foreach ($IdDnnonceExpirer as  $value) {
        $annonceExpirerAvecUneSeuleImage[]=$imagesRpo->findByImagePrincipale($value);
      }
      // annonce en ligne
      $usersEnLigne=$annoncesRepository->findAllAnnonceEnLigne($user->getId());

      //je recupere id des annonces en cours
      $IdDnnonce=[];
      foreach ($usersEnLigne as  $value) {
        $IdDnnonce[]=$value->getId();
      }
      //je recupere les annonces via les images
      $annnonceAvecUneSeuleImage=[];
      foreach ($IdDnnonce as  $id) {
        $annnonceAvecUneSeuleImage[]=$imagesRpo->findByImagePrincipale($id);
      }

    //  dd($annnonceAvecUneSeuleImage);



    return $this->render('user_account/index.html.twig',[
      'users'=> $annonceExpirerAvecUneSeuleImage,
      'user' =>$user,
      'usersEnLigne'=>$annnonceAvecUneSeuleImage
    ]);

  }







}
