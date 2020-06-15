<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Images;

use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;

/**
 * @Route("/annonces")
 */
class AnnoncesController extends AbstractController
{
    // /**
    //  * @Route("/", name="annonces_index", methods={"GET"})
    //  */
    // public function index(AnnoncesRepository $annoncesRepository): Response
    // {
    //     return $this->render('annonces/index.html.twig', [
    //         'annonces' => $annoncesRepository->findAll(),
    //
    //     ]);
    // }

    /**
     * @Route("/new", name="annonces_new", methods={"GET","POST"})
     */
    public function new(AnnoncesRepository $annoncesRepository, Request $request): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);
        $InfoUser=$this->getUser();
        $totalAnn=$annoncesRepository->TotalAnnonce($InfoUser->getId());
        if ($totalAnn[1] >= 10) {
          return $this->redirectToRoute('user_account');
        }

      //dd($InfoUser->getId());


        if ($form->isSubmitted() && $form->isValid()) {
          
           // on gere l'image ici

           $images=$form->get('images')->getData();

          //
          foreach ($images as  $image) {
          $fichier=md5(uniqid()).'.'.$image->guessExtension();
          try {
               $image->move(
                   $this->getParameter('chemin_image'),
                   $fichier
               );
               $img= new Images();
               $img->setNom($fichier);
               $annonce->addImage($img);
           }catch (FileException $e) {
               throw $this->createNotFoundException('Erreur dans le chargement du fichier');
           }


          }

            $user=$this->getDoctrine()->getRepository(Users::class)->find($this->getUser()->getID());

            $annonce->setUsers($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('user_account');
        }

        return $this->render('annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView(),
            'InfoUser'=>$InfoUser,

        ]);
    }

    // /**
    //  * @Route("/{id}", name="annonces_show", methods={"GET"})
    //  */
    // public function show(Annonces $annonce): Response
    // {
    //     return $this->render('annonces/show.html.twig', [
    //         'annonce' => $annonce,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="annonces_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, Annonces $annonce): Response
    // {
    //     $form = $this->createForm(AnnoncesType::class, $annonce);
    //     $form->handleRequest($request);
    //
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();
    //
    //         return $this->redirectToRoute('annonces_index');
    //     }
    //
    //     return $this->render('annonces/edit.html.twig', [
    //         'annonce' => $annonce,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="annonces_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Annonces $annonce): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($annonce);
    //         $entityManager->flush();
    //     }
    //
    //     return $this->redirectToRoute('annonces_index');
    // }
}
