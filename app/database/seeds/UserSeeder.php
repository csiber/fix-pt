<?php

class UserSeeder extends DatabaseSeeder {

    public function run() {
        $users = [
            [
                "username" => "christopher.pitt",
                "password" => Hash::make("okidoki"),
                "email" => "chris@example.com",
                "permission" => 1
            ],
            [
                "username" => "miguelgazela",
                "password" => Hash::make("password"),
                "email" => "miguelgazela",
                "permission" => 1
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }

}

?>
