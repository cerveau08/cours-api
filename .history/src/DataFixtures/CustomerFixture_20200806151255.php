<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Invoice;
use App\Entity\Customer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CustomerFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $chrono = 1;

        for($u = 0; $u < 10; $u++) {
            $user = new User();
            $user->setFirstName()
        }

        for($c = 0; $c < 30; $c++) {
            $customer = new Customer();
            $customer->setFirstName($faker->firstName())
                     ->setLastName($faker->lastName())
                     ->setCompany($faker->company())
                     ->setEmail($faker->email());
            $manager->persist($customer);

            for($i = 0; $i < mt_rand(3, 10); $i++) {
                $invoice = new Invoice();
                $invoice->setAmount($faker->randomFloat(2, 250, 5000))
                        ->setSentAt($faker->dateTimeBetween('-6 months'))
                        ->setStatus($faker->randomElement(['SENT', 'PAID', 'CANCELED']))
                        ->setCustomer($customer)
                        ->setChrono($chrono);
                $chrono++; 
                
                $manager->persist($invoice);
            }
        }

        $manager->flush();
    }
}
