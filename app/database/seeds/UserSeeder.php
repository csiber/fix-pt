<?php

class UserSeeder extends DatabaseSeeder {

    public function run() {
        $users = [
            [
                "username" => "christopher.pitt",
                "email" => "chris@example.com",
                "password" => Hash::make("okidoki"),
                "name" => "Christopher Pitt",
                "permission" => 1
            ],
            [
                "username" => "miguelgazela",
                "email" => "miguelgazela",
                "password" => Hash::make("password"),
                "name" => "Miguel Oliveira",
                "permission" => 1
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }

}

?>
