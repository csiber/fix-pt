<?php

class CategorySeeder extends DatabaseSeeder
{
    public function run()
    {
        $categories = [
            [ "name" => "Home" ],
            [ "name" => "Gardening" ],
            [ "name" => "Mechanics" ],
            [ "name" => "Electronics" ],
            [ "name" => "Appliances" ]
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}

?>