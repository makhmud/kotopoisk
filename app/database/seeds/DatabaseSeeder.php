<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');

        $this->command->info('User table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        $userIds = [];
        $catIds = [];
        $contactsIds = [];

        DB::table('contacts')->delete();

        for ($i = 0; $i<31; $i++){
            Contact::insert(array(
                'name' => 'Алексей',
                'surname' => 'Степанов',
                'city' => 'Рейкъявик',
                'web' => 'http://google.com',
                'phone' => '+790990990'
            ));
            $contactsIds[] = DB::getPdo()->lastInsertId();
        }

        DB::table('users')->whereNotIn('id', array(1))->delete();

        foreach ($contactsIds as $contactsId){
            User::insert(
                array(
                    array('email' => Str::random(10).'@mail.com', 'password'=>Hash::make('123123'), 'is_admin'=>true, 'id_contacts' => $contactsId),
                ));
            $userIds[] = DB::getPdo()->lastInsertId();
        }

        DB::table('cats')->delete();

        for ($i = 0; $i<60; $i++){
            Cat::insert(array(
                'position' => round(mt_rand(400000000,600000000)/10000000, 7) . ',' . round(mt_rand(200000000,500000000)/10000000, 7),
                'id_author' => $userIds[array_rand($userIds)],
                'content' => 'СПб, в районе метро Кировский Завод. Найдена сиамская (тайская) кошка. Сидела в подъезде дома с растерянным видом. Похоже совсем недавно потерялась. Очень ласковая, несомненно домашняя. Хотим найти ее хозяев! Она по ним скучает, часто мяукает. С виду - совершенно здорова, хорошо ест. Судя по животу, недавно рожала и вскармливала котят. Звоните: +7 921 422 29 76. Люба.',
                'created_at' => $string = date("Y-m-d H:i:s", mt_rand(1262055681,time()))
            ));
            $catIds[] = DB::getPdo()->lastInsertId();
        }

        DB::table('like')->delete();
        $insertValues = [];
        for ($i = 0; $i<500; $i++){
            $insertValues[] = array(
                'id_author' => $userIds[array_rand($userIds)],
                'id_cats' => $catIds[array_rand($catIds)],
            );
        }
        Like::insert($insertValues);

        DB::table('photo')->delete();

        for ($i = 0; $i<120; $i++){
            Photo::insert(array(
                'path' => (array_rand(array(1,2,3))+1).'.png',
                'id_cats' => $catIds[array_rand($catIds)],
            ));
        }

        DB::table('translations')->delete();

        Translation::insert([
            [
                'lng' => 'en',
                'key' => 'page.about.title',
                'value' => 'About project'
            ],
            [
                'lng' => 'ru',
                'key' => 'page.about.title',
                'value' => 'О проекте'
            ]
        ]);

    }

}