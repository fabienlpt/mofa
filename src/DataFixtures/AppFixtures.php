<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $table = ['Brand Designer','Curren Business', ' Curren Sport', 'Hip Hop Gold', 'Jaragar Racing', 'Liges Hommes', 'Maserati Mechanical', 'Mesh Genova', 'Montre Mecanique', 'Quarz Luxe', 'Relogio Masculino', 'Tissot Multifunction'];
        for ($i = 0; $i < 12; ++$i ) {
            $article = new Article();
            $article -> setTitle($table[$i]);
            $article -> setDescription('La montre '.$table[$i].' est une jolie montre créer par xxx.');
            $article -> setImage('img/im'.($i + 1).'.jpg');
            $article -> setPrice(mt_rand(10, 100));

            $manager->persist($article);
        }

        $user = new User();
        $user->setEmail('admin.mofa@gmail.com');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'pass_1234');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}
