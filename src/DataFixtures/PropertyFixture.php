<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0 ; $i < 100; $i++) {
            $property = new Property();
            $property
                ->setName($faker->words(3, true))
                ->setDescription($faker->sentences(4, true))
                ->setSurface($faker->numberBetween(10, 650))
                ->setSurfaceTer($faker->numberBetween(0, 100))
                ->setRooms($faker->numberBetween(1, 15))
                ->setBedrooms($faker->numberBetween(1, 8))
                ->setPrice($faker->numberBetween(100000, 10000000))
                ->setEnergyClass($faker->numberBetween(0, count(Property::ENERGY ) - 1))
                ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1))
                ->setType($faker->numberBetween(0, count(Property::TYPE) -1))
                ->setCity($faker->city)
                ->setAdress($faker->address)
                ->setZipCode($faker->postcode)
                ->setSold(false);
            $manager->persist($property);
        }
        $manager->flush();
    }
}
