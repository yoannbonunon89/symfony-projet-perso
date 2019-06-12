<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;
use App\Entity\Category;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ["Caritative", "Sportive", "Revandicative"];
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->setName($category);
            $manager->persist($newCategory);
        }
        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);
        $events = [
            [
                "name" => "Gilet jaune",
                "description" => "Reunion Gilet jaune",
                "declarer" => 1,
                "date" => "2017-05-18",
                "startTime" => "10:10:10",
                "endTime" => "18:10:10",
                "category" => 3,
            ],
            [
                "name" => "Piscine",
                "description" => "Reunion Piscine",
                "declarer" => 0,
                "date" => "2014-03-12",
                "startTime" => "10:12:19",
                "endTime" => "18:15:14",
                "category" => 2,
            ],
            [
                "name" => "Vide-Grenier",
                "description" => "Reunion Vide-Grenier ",
                "declarer" => 1,
                "date" => "2017-06-18",
                "startTime" => "08:11:10",
                "endTime" => "22:14:10",
                "category" => 1,
            ],
        ];
        foreach ($events as $event) {
            $newEvent = new Event();
            $newEvent->setName($event["name"])
                ->setDescription($event["description"])
                ->setDeclarer((bool)$event["declarer"])
                ->setDate($event["date"])
                ->setStartTime($event["startTime"])
                ->setTimeEnd($event["endTime"])
                ->setCategory($newCategory);
            $manager->persist($newEvent);
        }
        $manager->flush();
    }
}
