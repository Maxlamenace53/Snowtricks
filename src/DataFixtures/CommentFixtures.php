<?php

namespace App\DataFixtures;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CommentFixtures extends Fixture implements DependentFixtureInterface
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

        $user1 = $this->getReference('user1');
        $user2 = $this->getReference('user2');
        $user3 = $this->getReference('user3');
        $user4 = $this->getReference('user4');

        $userArray = [$user1, $user2, $user3, $user4];


        $trick1 = $this->getReference('trick1');
        $trick2 = $this->getReference('trick2');
        $trick3 = $this->getReference('trick3');
        $trick4 = $this->getReference('trick4');
        $trick5 = $this->getReference('trick5');
        $trick6 = $this->getReference('trick6');

        $trickArray = [$trick1, $trick2, $trick3, $trick4, $trick5, $trick6];


        for ($i =1; $i<=200; $i++ ){
            $trickArrayRand = array_rand($trickArray,1);
            $userArrayRand = array_rand($userArray, 1);
            $commment = new Comment();
            $commment
                ->setUser($userArray[$userArrayRand])
                ->setTrick($trickArray[$trickArrayRand])
                ->setComment($this->faker->text(200, true))
                ->setCreateDate(new \DateTimeImmutable($this->faker->date));
            $manager->persist($commment);

        }

        $manager->flush();
    }
    public function getDependencies() :array
    {
        return [TrickFixtures::class, UserFixtures::class];
    }
}
