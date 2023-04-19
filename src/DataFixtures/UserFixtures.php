<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserFixtures extends Fixture
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
        $admin = new User();
        $admin->setFirstname('admin')->setLastname('admin')
        ->setNickname($this->faker->userName)
        ->setEmail('admin@mail.com')
        ->setPassword('password')
        ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
        ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
        ->setDescription($this->faker->paragraph)
        ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);



        $user1 = new User();
        $user1->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
        ->setNickname($this->faker->userName)
        ->setEmail($this->faker->email)
        ->setPassword('password')
        ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
        ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
        ->setDescription($this->faker->paragraph)
        ->setRoles(['ROLE_USER']);
        $manager->persist($user1);
        $this->addReference("user1", $user1);


        $user2 = new User();
        $user2->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
        ->setNickname($this->faker->userName)
        ->setEmail($this->faker->email)
        ->setPassword('password')
        ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
        ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
        ->setDescription($this->faker->paragraph)
        ->setRoles(['ROLE_USER']);
        $manager->persist($user2);
        $this->addReference("user2", $user2);


        $user3 = new User();
        $user3->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
            ->setNickname($this->faker->userName)
            ->setEmail($this->faker->email)
            ->setPassword('password')
            ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
            ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
            ->setDescription($this->faker->paragraph)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user3);
        $this->addReference("user3", $user3);


        $user4 = new User();
        $user4->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
            ->setNickname($this->faker->userName)
            ->setEmail($this->faker->email)
            ->setPassword('password')
            ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
            ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
            ->setDescription($this->faker->paragraph)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user4);
        $this->addReference("user4", $user4);








        $manager->flush();




    }
}
