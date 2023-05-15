<?php

namespace App\DataFixtures;
use App\Entity\Trick;
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
        $groupArray = [$groupeEasy, $groupeMedium, $groupeDifficile, $groupeHard];

        $user1 = $this->getReference('user1');
        $user2 = $this->getReference('user2');
        $user3 = $this->getReference('user3');
        $user4 = $this->getReference('user4');
        $userArray = [$user1, $user2, $user3, $user4];

        for ($i =1; $i<=10; $i++ ) {
            $groupArrayRand = array_rand($groupArray, 1);
            $userArrayRand = array_rand($userArray, 1);
            $trick = new Trick();
            $trick->setNameTrick($this->faker->country . $this->faker->colorName)
                ->setDescription($this->faker->text)
                ->setCreationDate(new \DateTimeImmutable($this->faker->date()))
                ->setGroupTrick($groupArray[$groupArrayRand])
                ->setMainPhoto($this->faker->image('public/uploads', 640, 480, null, false, true, 'Photo principal du trick ' . $trick->getNameTrick()))
                ->setUser($userArray[$userArrayRand]);
            $manager->persist($trick);
            $this->addReference('trick' . $i, $trick);
        }


       $manager->flush();
    }

    public function getDependencies() :array
    {
        return [GroupFixtures::class, UserFixtures::class];
    }
}


