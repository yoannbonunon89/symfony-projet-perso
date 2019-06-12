<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $categories = ["Caritative", "Sportive", "Revandicative"];
        // foreach ($categories as $category) {
        //     $newCategory = new Category();
        //     $newCategory->setName($category);
        //     $manager->persist($newCategory);
        // }
        // $manager->flush();
    }
}
