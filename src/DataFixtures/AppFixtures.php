<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Emplacements;
use App\Entity\Personnels;
use App\Entity\Marques;
use App\Entity\Modeles;
use App\Entity\Caracteristiques;
use App\Entity\Pannes;
use App\Entity\TypeMateriels;
use App\Entity\Equipements;
use App\Entity\Reparations;
use App\Entity\PiecesChanger;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i < 51; $i++) {
            
            //Creation personnel

            $pers = new Personnels();
            $pers->setEmail($this->faker->freeEmail());
            $pers->setNom($this->faker->lastName());
            $pers->setPrenom($this->faker->firstName());
            $pers->setSexe($this->faker->randomElement(["Masculin","Feminin"]));
            $pers->setTelephone($this->faker->phoneNumber());
            $pers->setFonction($this->faker->jobTitle());
            $pers->setRoles(array('ROLE_CUSTOMER_MANAGER'));
            $pers->setPassword($this->faker->password(8, 10));    

            //Création Emplacement

            $emplacement = new Emplacements();
            $emplacement->setSalle($this->faker->randomElement(["Dispensation", "Informatique", "Recouvrement", "Accueil", "Technique"]));
            $emplacement->setBureau($this->faker->numerify('ILEAD-YDE-####'));
            $emplacement->addPersonnel($pers);
                
            //Creation de la panne
            
            $panne = new Pannes();
            $panne->setDiagnostic($this->faker->paragraph());
            $panne->setDatePanne($this->faker->dateTime('d_m_Y'));
            
            
            //Creation Equipement
            
            $equip = new Equipements();
            $equip->setNumeroSerie($this->faker->uuid());
            $equip->setSonEtat($this->faker->randomElement(["Bon","Mauvais","Vetuste"]));
            $equip->setDateAcquisition($this->faker->dateTime('Y_m_d'));
            $equip->addPanne($panne);
            $pers->addEquipement($equip);

            //Creation de la Marque
            
            $marque = new Marques();
            $marque->setLibelle($this->faker->words(1, true));
            $marque->addEquipement($equip);

            //Creation du Modele

            $mod = new Modeles();
            $mod->setLibelle($this->faker->words(1, true));
            $mod->addEquipement($equip);

            //Creation des reparation

            $repare = new Reparations();
            $repare->setDateReparation($this->faker->dateTime('d_m_Y'));
            $repare->setCommentaire($this->faker->paragraph());
            
            //Cretation des pièces à changer

            $piece = new PiecesChanger();
            $piece->setDetails($this->faker->paragraph());
            $piece->addReparation($repare);
            
            //Creation des caractéristiques

            $car = new Caracteristiques();
            $car->setLibelle($this->faker->paragraph());
            $car->addPiecesChanger($piece);

            //Creation du type de matériel  
            
            $typeMat = new TypeMateriels();
            $typeMat->setLibelle($this->faker->words(3, true));
            $typeMat->addEquipement($equip);
            $typeMat->addCaracteristique($car);


            $manager->persist($pers);
            $manager->persist($emplacement); 
            $manager->persist($panne);
            $manager->persist($equip);
            $manager->persist($marque);
            $manager->persist($mod);
            $manager->persist($repare);
            $manager->persist($piece);
            $manager->persist($car);
            $manager->persist($typeMat);

        }
        $manager->flush();
        
    }

        
}
