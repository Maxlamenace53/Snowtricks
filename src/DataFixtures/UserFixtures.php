<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
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
        $admin = new User();
        $admin->setFirstname('admin')->setLastname('admin')
        ->setNickname($this->faker->userName)
        ->setEmail('admin@mail.com')
        ->setPassword($this->hasher->hashPassword($admin, 'password'))
        ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
        ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
        ->setDescription($this->faker->paragraph)->setIsVerified(true)
        ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);



        $user1 = new User();
        $user1->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
        ->setNickname($this->faker->userName)
        ->setEmail('max@mail.com')
        ->setPassword($this->hasher->hashPassword($admin, 'password'))
        ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
        ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
        ->setDescription($this->faker->paragraph)->setIsVerified(true)
         ->setRoles(['ROLE_USER']);
        $manager->persist($user1);
        $this->addReference("user1", $user1);


        $user2 = new User();
        $user2->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
        ->setNickname($this->faker->userName)
        ->setEmail($this->faker->email)
        ->setPassword($this->hasher->hashPassword($admin, 'password'))
        ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
        ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
        ->setDescription($this->faker->paragraph)->setIsVerified(true);
        $manager->persist($user2);
        $this->addReference("user2", $user2);


        $user3 = new User();
        $user3->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
            ->setNickname($this->faker->userName)
            ->setEmail($this->faker->email)
            ->setPassword($this->hasher->hashPassword($admin, 'password'))
            ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
            ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
            ->setDescription($this->faker->paragraph)->setIsVerified(true);
        $manager->persist($user3);
        $this->addReference("user3", $user3);


        $user4 = new User();
        $user4->setFirstname($this->faker->firstName)->setLastname($this->faker->lastName)
            ->setNickname($this->faker->userName)
            ->setEmail($this->faker->email)
            ->setPassword($this->hasher->hashPassword($admin, 'password'))
            ->setAvatar($this->faker->imageUrl(200, 200, 'cats', true, 'Faker'))
            ->setRegistrationDate(new \DateTimeImmutable($this->faker->date()))
            ->setDescription($this->faker->paragraph)->setIsVerified(true);
        $manager->persist($user4);
        $this->addReference("user4", $user4);








        $manager->flush();




    }
}
