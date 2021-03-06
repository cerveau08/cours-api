<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($c = 0; $c < 30; $c++) {
            $customer = new Customer();
            $customer->setFirstName($faker->firstName())
                     ->setLastName($faker->lastName)
                     ->setCompany($faker->company)
                     ->setEmail($faker->email);
            
        }

        $manager->flush();
    }
}
