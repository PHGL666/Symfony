<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail("pierre.jehan@gmail.com");
        $admin->setPassword($this->encoder->encodePassword($admin, '1234'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $this->setReference("user-admin", $admin);

        $john = new User();
        $john->setEmail("john.doe@gmail.com");
        $john->setPassword($this->encoder->encodePassword($john, '1234'));
        $manager->persist($john);
        $this->setReference("user-john", $john);

        $manager->flush();
    }
}
