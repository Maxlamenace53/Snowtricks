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

        $trick1 = $this->getReference('trick1');
        $trick2 = $this->getReference('trick2');
        $trick3 = $this->getReference('trick3');
        $trick4 = $this->getReference('trick4');
        $trick5 = $this->getReference('trick5');
        $trick6 = $this->getReference('trick6');


        $comment1 = new Comment();
        $comment1
            ->setComment($this->faker->paragraph)
            ->setUser($user1)
            ->setTrick($trick1)
            ->setCreateDate($this->faker->dateTime);
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2
            ->setComment($this->faker->paragraph)
            ->setUser($user1)
            ->setTrick($trick3)
            ->setCreateDate($this->faker->dateTime);
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3
            ->setComment($this->faker->paragraph)
            ->setUser($user2)
            ->setTrick($trick4)
            ->setCreateDate($this->faker->dateTime);
        $manager->persist($comment3);

        $comment4 = new Comment();
        $comment4
            ->setComment($this->faker->paragraph)
            ->setUser($user3)
            ->setTrick($trick1)
            ->setCreateDate($this->faker->dateTime);
        $manager->persist($comment4);

        $comment5 = new Comment();
        $comment5
            ->setComment($this->faker->paragraph)
            ->setUser($user4)
            ->setTrick($trick1)
            ->setCreateDate($this->faker->dateTime);
        $manager->persist($comment5);





        $manager->flush();
    }
    public function getDependencies() :array
    {
        return [TrickFixtures::class, UserFixtures::class];
    }
}
