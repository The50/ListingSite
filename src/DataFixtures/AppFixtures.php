<?php

namespace App\DataFixtures;

use App\Entity\Listing;
//use App\Entity\User;
//use App\Entity\UserPreferences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
//    private const USERS = [
//        [
//            'username' => 'john_doe',
//            'email' => 'john_doe@doe.com',
//            'password' => 'john123',
//            'fullName' => 'John Doe',
//            'roles' => [User::ROLE_USER]
//        ],
//        [
//            'username' => 'rob_smith',
//            'email' => 'rob_smith@smith.com',
//            'password' => 'rob12345',
//            'fullName' => 'Rob Smith',
//            'roles' => [User::ROLE_USER]
//        ],
//        [
//            'username' => 'marry_gold',
//            'email' => 'marry_gold@gold.com',
//            'password' => 'marry12345',
//            'fullName' => 'Marry Gold',
//            'roles' => [User::ROLE_USER]
//        ],
//        [
//            'username' => 'super_admin',
//            'email' => 'super_admin@admin.com',
//            'password' => 'admin12345',
//            'fullName' => 'Micro Admin',
//            'roles' => [User::ROLE_ADMIN]
//        ],
//    ];

    private const POST_TEXT = [
        'Hello, how are you?',
        'It\'s nice sunny weather today',
        'I need to buy some ice cream!',
        'I wanna buy a new car',
        'There\'s a problem with my phone',
        'I need to go to the doctor',
        'What are you up to today?',
        'Did you watch the game yesterday?',
        'How was your day?'
    ];

    private const LANGUAGES = [
        'en',
        'fr'
    ];

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadListings($manager);
    }

    private function loadListings(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {
            $listing = new Listing();
            $listing->setText(
                self::POST_TEXT[rand(0, count(self::POST_TEXT) - 1)]
            );
            $listing->setTitle(
                'Random title '.rand(0, 1001)
            );
            $date = new \DateTime();
            $date->modify('-' . rand(0, 10) . ' day');
            $listing->setTime($date);
//            $microPost->setUser($this->getReference(
//                self::USERS[rand(0, count(self::USERS) - 1)]['username']
//            ));
            $manager->persist($listing);
        }

        $manager->flush();
    }
}