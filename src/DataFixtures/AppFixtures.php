<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Images;
use App\Entity\Categorie;
use App\Entity\Zone;
use App\Entity\Etat;
use App\Entity\Rubrique;
use App\Entity\Region;
use App\Entity\Quartier;
use App\Entity\Annonces;
use App\Entity\Users;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
  private $encoder;

  public function __construct(UserPasswordEncoderInterface $encoder)
  {
    $this->encoder = $encoder;
  }
  public function load(ObjectManager $manager)
  {
    $faker=Factory::create();
    // $product = new Product();
    // $manager->persist($product);
    $annonces=[];
    $users=[];
    $etats=[];
    $rubriques=[];
    $quartiers=[];
    $images=[];
    $regions=[];
    $zones=[];
    $categories=[];

    //Etat
    for ($i=0; $i < 3; $i++) {
      $etat= new Etat();
      $etat->setEtat($faker->word);
      $manager->persist($etat);
      $etats[]=$etat;
    }
    // fin Etat
    //Quartier
    for ($i=0; $i < 4 ; $i++) {
      $quartier=new Quartier();
      $quartier->setNom($faker->streetName);
      $manager->persist($quartier);
      $quartiers[]=$quartier;
    }
    //fin Quartier
    //Region

    for ($i=0; $i < 4 ; $i++) {
      $region=new Region();
      $region->setNom($faker->city);
      $manager->persist($region);
      $regions[]=$region;
    }
    //fin region
    //zone
    for ($i=0; $i < 4 ; $i++) {
      $zone =new Zone();
      $zone->setNom($faker->state);
      $manager->persist($zone);
      $zones[]=$zone;
    }
    // fin zone
    //rubrique
    for ($i=0; $i < 4 ; $i++) {
      $rubrique=new Rubrique();
      $rubrique->setNom($faker->word);
      $manager->persist($rubrique);
      $rubriques[]=$rubrique;
    }
    // fin rubrique
    //categorie
    for ($i=0; $i < 4 ; $i++) {
      $categori=new Categorie();
      $categori->setNom($faker->word)
      ->setNom($faker->sentence(2,true))
      ->setRubrique($faker->randomElement($rubriques))
      ;
      $manager->persist($categori);
      $categories[]=$categori;

    }
    //fin categorie
    //user
    $user = new Users();
    $user->setEmail('ousmanedia846@gmail.com');
    $user->setNomComplet('ousmane dia');
    $user->setNumeroDeTel('775504905');

    $password = $this->encoder->encodePassword($user, '123456');
    $user->setPassword($password);

    $manager->persist($user);
    $users[]=$user;
    for ($i=1; $i < 20 ; $i++) {
      $user = new Users();
      $user->setEmail($faker->email);
      $user->setNomComplet($faker->firstName);
      $user->setNumeroDeTel($faker->e164PhoneNumber);

      $password = $this->encoder->encodePassword($user, '123456');
      $user->setPassword($password);

      $manager->persist($user);
      $users[]=$user;
    }
    //fin user
    //annonces
    for ($i=0; $i < 20 ; $i++) {
      $annonce=new Annonces();
      $annonce->setTitre($faker->sentence(4,true))
      ->setPrix($faker->randomNumber(NULL,false))
      ->setDescription($faker->text(200))
      ->setPrixNegociable($faker->boolean)
      ->setPrixNegociable($faker->boolean(50))
      ->setPossibiliteEchange($faker->boolean(50))
      ->setPossibiliteEchange($faker->boolean)
      ->setUsers($faker->randomElement($users))
      ->setCategorie($faker->randomElement($categories))
      ->setEtat($faker->randomElement($etats))
      ->setRegion($faker->randomElement($regions))
      ->setQuartier($faker->randomElement($quartiers))
      ->setZone($faker->randomElement($zones))
      ;
      $manager->persist($annonce);
      $annonces[]=$annonce;

    }
    //fin annonce
    //images

    for ($i=0; $i < 20 ; $i++) {
      $image = new Images();
      $image->setNom($faker->imageUrl(640,480,'sports'))
      ->setNom($faker->imageUrl(640,480,'people'))
      ->setNom($faker->imageUrl(640,480,'cats'))
      ->setNom($faker->imageUrl(640,480,'transport'))
      ->setNom($faker->imageUrl(640,480,'business'))
      ->setNom($faker->imageUrl(640,480,'technics'))
      ->setNom($faker->imageUrl(640,480,'abstract'))
      ->setNom($faker->imageUrl(640,480,'animals'))
      ->setNom($faker->imageUrl(640,480,'city'))
      ->setNom($faker->imageUrl(640,480,'nature'))
      ->setNom($faker->imageUrl(640,480,'food'))
      ->setNom($faker->imageUrl(640,480,'fashion'))
      ->setNom($faker->imageUrl(640,480,'nightlife'))

      ->setImagePrincipale($faker->boolean)
      ->setAnnonces($faker->randomElement($annonces))
      ;
      $manager->persist($image);
    }
    //fin image

    $manager->flush();
  }
}
