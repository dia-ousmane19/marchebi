<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RubriqueRepository;
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
  public function AllAnnoncesByCategorie(PaginatorInterface $paginator,Request $request,AnnoncesRepository $annoncesRepository,  $slug)
  {
    $InfoUser=$this->getUser();
    //$annonces=$categorieRepository->findAnnonceBySlug($slug);
    //dd($annonces);

     //dd($annonces);

   $donnee=$annoncesRepository->findAllAnnoncesByCategorie($slug);
   $annonces = $paginator->paginate(
       $donnee, /* query NOT result */
       $request->query->getInt('page', 1), /*page number*/
       6 /*limit per page*/
   );
  // dd($donnee);
    if (!$donnee) {
    return $this->redirectToRoute('annonce_indisponible');
      //throw $this->createNotFoundException('Aucune annonce disponible');
    }
    // dd($annonces);

    return $this->render('home/categorie.html.twig',[
      'annonces' => $annonces,
      'InfoUser'=>$InfoUser,
    ]);
  }

  /**
  * @Route("/a/{slug}", name="annonce")
  */
  public function getAnnonceComplet(AnnoncesRepository $annoncesRepository,$slug)
  {
    $annonceComplete=$annoncesRepository->FindAnnonceBySlug($slug);
    //dd($annonceComplete);
    $InfoUser=$this->getUser();
    return $this->render('home/annonce.html.twig',[
      'annonceComplete' => $annonceComplete,
      'InfoUser'=>$InfoUser
    ]);
  }

  /**
  * @Route("/aucune-annonce-disponible", name="annonce_indisponible")
  */
  public function AnnonceInexistante()
  {
    return $this->render('annonces/AnnonceInexistante.html.twig');
  }


}
