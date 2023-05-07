<?php

namespace App\DataFixtures;

use App\Entity\VideoTrick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class VideoTrickFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('fr_FR');
        $this->hasher = $hasher;
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


        //trick1
        $video1 = new VideoTrick();
        $video1->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick1)
            ->setUser($user1)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video1);

        $video2 = new VideoTrick();
        $video2->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick1)
            ->setUser($user1)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video2);

        $video3 = new VideoTrick();
        $video3->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick1)
            ->setUser($user2)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video3);

        //trick2
        $video4 = new VideoTrick();
        $video4->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick2)
            ->setUser($user2)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video4);

        $video5 = new VideoTrick();
        $video5->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick2)
            ->setUser($user2)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video5);

        $video6 = new VideoTrick();
        $video6->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick2)
            ->setUser($user3)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video6);

        //trick3
        $video7 = new VideoTrick();
        $video7->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick3)
            ->setUser($user3)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video7);

        $video8 = new VideoTrick();
        $video8->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick3)
            ->setUser($user4)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video8);

        $video9 = new VideoTrick();
        $video9->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick3)
            ->setUser($user4)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video9);

        //trick4
        $video10 = new VideoTrick();
        $video10->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick4)
            ->setUser($user2)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video10);

        $video11 = new VideoTrick();
        $video11->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick4)
            ->setUser($user2)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video11);

        //trick5
        $video12 = new VideoTrick();
        $video12->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick5)
            ->setUser($user1)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video12);

        $video13 = new VideoTrick();
        $video13->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick5)
            ->setUser($user1)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video13);

        $video14 = new VideoTrick();
        $video14->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick5)
            ->setUser($user2)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video14);

        //trick6
        $video15 = new VideoTrick();
        $video15->setVideo('https://www.youtube.com/embed/EzGPmg4fFL8')
            ->setTrick($trick6)
            ->setUser($user1)
            ->setDateAdded(new \DateTimeImmutable($this->faker->date()));
        $manager->persist($video15);










        $manager->flush();
    }

    public function getDependencies() :array
    {
        return [TrickFixtures::class, UserFixtures::class];
    }
}
