<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Evenements;
use Faker;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class EvenementsFixtures extends Fixture{

    public function load(ObjectManager $manager){
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        //On créé 40 évenements
        for($i=0;$i<40;$i++){
            $evenement=new Evenements();
            //$evenement->setFilename($faker->word);
            $evenement->setTitle($faker->words(3,true));
            $evenement->setCategory($faker->words(2,true));
            $evenement->setDescription($faker->paragraph($nbSentences = 3, $variableNbSentences = true));
            $evenement->setAdresse($faker->address);
            $evenement->setLat(0);
            $evenement->setLng(0);
            //$evenement->setDate($faker->dateTimeThisDecade($max = 'now', 'Europe/Paris'));
            //
            $evenement->setDate($faker->dateTimeInInterval($startDate = '+0 years', $interval = '+ 3 years', $timezone = null));
            //$evenement->setDate($faker->dateTimeInInterval($startDate = '-3 years', $interval = '+ 3 years', $timezone = null));
            $manager->persist($evenement);
        }
        $manager->flush();
    }
}