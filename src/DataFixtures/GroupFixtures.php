<?php

namespace App\DataFixtures;

use App\Entity\GroupTrick;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $groupEasy = new GroupTrick();
        $groupEasy->setName('Groupe Easy')
        ->setLogo('groupe_easy.png');
        $manager->persist($groupEasy);
        $this->addReference('groupe-easy',$groupEasy);

        $groupMedium = new GroupTrick();
        $groupMedium->setName('Groupe Medium')
        ->setLogo('groupe_medium.png');
        $manager->persist($groupMedium);
        $this->addReference('groupe-medium',$groupMedium);

        $groupDifficile = new GroupTrick();
        $groupDifficile->setName('Groupe Difficile')
        ->setLogo('groupe_difficile.png');
        $manager->persist($groupDifficile);
        $this->addReference('groupe-difficile',$groupDifficile);

        $groupHard = new GroupTrick();
        $groupHard->setName('Groupe Hard')
        ->setLogo('groupe_hard.png');
        $manager->persist($groupHard);
        $this->addReference('groupe-hard',$groupHard);



        $manager->flush();
    }
}
