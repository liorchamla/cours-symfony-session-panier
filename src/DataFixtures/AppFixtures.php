<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Liior\Faker\Prices($faker));

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setTitle($faker->productName)
                ->setPrice($faker->price(20, 200))
                ->setImage($faker->imageUrl(400, 400));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
