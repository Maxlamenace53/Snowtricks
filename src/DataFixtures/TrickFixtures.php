<?php

namespace App\DataFixtures;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {
        $groupeEasy = $this->getReference('groupe-easy');
        $groupeMedium = $this->getReference('groupe-medium');
        $groupeDifficile = $this->getReference('groupe-difficile');
        $groupeHard = $this->getReference('groupe-hard');

        $user1 = $this->getReference('user1');
        $user2 = $this->getReference('user2');
        $user3 = $this->getReference('user3');
        $user4 = $this->getReference('user4');



       $trick1= new Trick();
       $trick1->setNameTrick($this->faker->title)
        ->setDescription($this->faker->paragraph)
        ->setCreationDate($this->faker->dateTime)
        ->setGroupTrick($groupeEasy)
        ->setUser($user1);
       $manager->persist($trick1);

        $trick2= new Trick();
        $trick2->setNameTrick($this->faker->title)
            ->setDescription($this->faker->paragraph)
            ->setCreationDate($this->faker->dateTime)
            ->setGroupTrick($groupeEasy)
            ->setUser($user1);
        $manager->persist($trick2);

        $trick3= new Trick();
        $trick3->setNameTrick($this->faker->title)
            ->setDescription($this->faker->paragraph)
            ->setCreationDate($this->faker->dateTime)
            ->setGroupTrick($groupeEasy)
            ->setUser($user2);
        $manager->persist($trick3);

        $trick4= new Trick();
        $trick4->setNameTrick($this->faker->title)
            ->setDescription($this->faker->paragraph)
            ->setCreationDate($this->faker->dateTime)
            ->setGroupTrick($groupeEasy)
            ->setUser($user3);
        $manager->persist($trick4);

        $trick5= new Trick();
        $trick5->setNameTrick($this->faker->title)
            ->setDescription($this->faker->paragraph)
            ->setCreationDate($this->faker->dateTime)
            ->setGroupTrick($groupeEasy)
            ->setUser($user4);
        $manager->persist($trick5);

        $trick6= new Trick();
        $trick6->setNameTrick($this->faker->title)
            ->setDescription($this->faker->paragraph)
            ->setCreationDate($this->faker->dateTime)
            ->setGroupTrick($groupeEasy)
            ->setUser($user3);
        $manager->persist($trick6);





       $manager->flush();
    }

    public function getDependencies() :array
    {
        return [GroupFixtures::class, UserFixtures::class];
    }
}
