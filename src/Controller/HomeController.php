<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RubriqueRepository;
use App\Repository\ImagesRepository;
use App\Entity\Rubrique;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategorieRepository;
use App\Repository\AnnoncesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class HomeController extends AbstractController
{

  /**
  * @Route("/", name="home")
  */
  public function index(RubriqueRepository $rubriqueRepository)
  {

    $allRubriques=$rubriqueRepository->AllRubriques();
    //dd();
    $InfoUser=$this->getUser();
    //on recupere toutes les rubriques
    // on recupere toutes les categories
    return $this->render('home/index.html.twig',[
      'allRubriques' => $allRubriques,
      'InfoUser'=>$InfoUser
    ]);
  }
  /**
  *
  * @Route("/categorie/{slug}", name="categorie")
  */
  public function AllAnnoncesByCategorie(PaginatorInterface $paginator,Request $request,AnnoncesRepository $annoncesRepository,ImagesRepository $imagesRpo,  $slug)
  {
    $InfoUser=$this->getUser();


   $donnee=$annoncesRepository->findAllAnnoncesByCategorie($slug);

   $array=[];
   foreach ($donnee as  $value) {
     $array[]=$value->getID();
   }
   $imagesPrincipale=[];
  //dd($array);
  foreach ($array as  $valu) {
    $imagesPrincipale[]=$imagesRpo->findByImagePrincipale($valu);

  }

//dd();
$annonces = $paginator->paginate(
    $imagesPrincipale, /* query NOT result */
    $request->query->getInt('page', 1), /*page number*/
    6 /*limit per page*/
);

    if (!$imagesPrincipale) {
    return $this->redirectToRoute('annonce_indisponible');
      //throw $this->createNotFoundException('Aucune annonce disponible');
    }


    return $this->render('home/categorie.html.twig',[
      'annonces' => $annonces,
      'InfoUser'=>$InfoUser,
    ]);
  }

  /**
  * @Route("/a/{slug}", name="annonce")
  */
  public function getAnnonceComplet(AnnoncesRepository $annoncesRepository,ImagesRepository $imagesRpo,$slug)
  {

    $annonceComplete=$annoncesRepository->FindAnnonceBySlug($slug);

    $ImagesAnnonce=$imagesRpo->findByImagePrincipale($annonceComplete->getId());
  //  dd($ImagesAnnonce);

    //dd($annonceComplete);
    $InfoUser=$this->getUser();
    //dd($InfoUser);
    return $this->render('home/annonce.html.twig',[
      'annonceComplete' => $annonceComplete,
      'InfoUser'=>$InfoUser,
      'ImageActive'=>$ImagesAnnonce
    ]);
  }

  /**
  * @Route("/aucune-annonce-disponible", name="annonce_indisponible")
  */
  public function AnnonceInexistante()
  {
    return $this->render('annonces/annonceInexistante.html.twig');
  }

  /**
  * @Route("/search-ajax", name="search_ajax_annonce")
  */
  public function searchAnnonce(ImagesRepository $imagesRpo,AnnoncesRepository $annoncesRepository,Request $request)
  {
    $search=$request->request->get('search');
    $resulat=$annoncesRepository->findAnnonceBySearch($search);
    if ($resulat === null) {
      echo "Aucune annonce trouvée.";
      die();
    }
    $getAllIdAnnonce=[];
    foreach ($resulat as  $value) {
      $getAllIdAnnonce[]=$value->getId();
    }
    //dd($getAllIdAnnonce);
    $resulatFinal=[];
    foreach ($getAllIdAnnonce as  $value) {
     $resulatFinal[]= $imagesRpo->findByImagePrincipale($value);
    }



   return $this->render('home/__resultat_recherche.html.twig',[
     'rechercheTrouvee'=>$resulatFinal
    ]);
  }


}
