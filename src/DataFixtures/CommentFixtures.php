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
        $trick7 = $this->getReference('trick7');
        $trick8 = $this->getReference('trick8');
        $trick9 = $this->getReference('trick9');
        $trick10 = $this->getReference('trick10');

        $trickArray = [$trick1, $trick2, $trick3, $trick4, $trick5, $trick6,$trick7,$trick8,$trick9,$trick10];


        for ($i =1; $i<=300; $i++ ){
            $trickArrayRand = array_rand($trickArray,1);
            $userArrayRand = array_rand($userArray, 1);
            $commment = new Comment();
            $commment
                ->setUser($userArray[$userArrayRand])
                ->setTrick($trickArray[$trickArrayRand])
                ->setComment($this->faker->text(200, true))
                ->setCreateDate(new \DateTimeImmutable($this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s')  ));
            $manager->persist($commment);

        }

        $manager->flush();
    }
    public function getDependencies() :array
    {
        return [TrickFixtures::class, UserFixtures::class];
    }
}
