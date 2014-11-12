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
                    array('email' => Str::random(10).'@mail.com', 'password'=>Hash::make('123123'), 'is_admin'=>false, 'id_contacts' => $contactsId),
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

        Translation::insert(array(
            array('id' => '1','lng' => 'en','key' => 'page.about.title','value' => 'About project'),
            array('id' => '2','lng' => 'ru','key' => 'page.about.title','value' => 'О проекте'),
            array('id' => '3','lng' => 'en','key' => 'menu.in','value' => 'Enter'),
            array('id' => '4','lng' => 'ru','key' => 'menu.in','value' => 'Войти'),
            array('id' => '5','lng' => 'en','key' => 'menu.out','value' => 'Exit'),
            array('id' => '6','lng' => 'ru','key' => 'menu.out','value' => 'Выйти'),
            array('id' => '7','lng' => 'en','key' => 'notification.register','value' => 'Almost done.'),
            array('id' => '8','lng' => 'ru','key' => 'notification.register','value' => 'Почти все.'),
            array('id' => '9','lng' => 'en','key' => 'notification.register.already_exists','value' => 'User already in database.'),
            array('id' => '10','lng' => 'ru','key' => 'notification.register.already_exists','value' => 'Пользователь уже существует.'),
            array('id' => '11','lng' => 'en','key' => 'notification.register.wrong_credentials','value' => 'Wrong E-mail or passwrod.'),
            array('id' => '12','lng' => 'ru','key' => 'notification.register.wrong_credentials','value' => 'Неверный E-mail или пароль.'),
            array('id' => '13','lng' => 'en','key' => 'notification.remind','value' => 'New rassword sent on your e-mail.'),
            array('id' => '14','lng' => 'ru','key' => 'notification.remind','value' => 'Новый пароль отправлен на Ваш e-mail.'),
            array('id' => '15','lng' => 'ru','key' => 'notification.pass_changed','value' => 'Пароль изменен.'),
            array('id' => '16','lng' => 'en','key' => 'notification.pass_changed','value' => 'Password changed.'),
            array('id' => '17','lng' => 'en','key' => 'notification.wrong_pass','value' => 'Wrong password.'),
            array('id' => '18','lng' => 'ru','key' => 'notification.wrong_pass','value' => 'Неверный пароль.'),
            array('id' => '19','lng' => 'en','key' => 'page.feed.title','value' => 'Feed'),
            array('id' => '20','lng' => 'ru','key' => 'page.feed.title','value' => 'Лента'),
            array('id' => '21','lng' => 'en','key' => 'page.feed.new','value' => 'New'),
            array('id' => '22','lng' => 'ru','key' => 'page.feed.new','value' => 'Новое'),
            array('id' => '23','lng' => 'en','key' => 'page.feed.popular','value' => 'Popular'),
            array('id' => '24','lng' => 'ru','key' => 'page.feed.popular','value' => 'Популярное'),
            array('id' => '25','lng' => 'en','key' => 'menu.add_cat','value' => '+ Add cat'),
            array('id' => '26','lng' => 'ru','key' => 'menu.add_cat','value' => '+ Добавить котэ'),
            array('id' => '27','lng' => 'en','key' => 'page.map.title','value' => 'Map'),
            array('id' => '28','lng' => 'ru','key' => 'page.map.title','value' => 'Карта'),
            array('id' => '29','lng' => 'en','key' => 'page.profile.title','value' => 'Profile'),
            array('id' => '30','lng' => 'ru','key' => 'page.profile.title','value' => 'Профиль'),
            array('id' => '31','lng' => 'en','key' => 'page.main.participants','value' => 'participants'),
            array('id' => '32','lng' => 'ru','key' => 'page.main.participants','value' => 'участников'),
            array('id' => '33','lng' => 'en','key' => 'page.main.signup','value' => 'Sign up'),
            array('id' => '34','lng' => 'ru','key' => 'page.main.signup','value' => 'Зарегистрируйтесь'),
            array('id' => '35','lng' => 'en','key' => 'page.main.signin','value' => 'Sign in'),
            array('id' => '36','lng' => 'ru','key' => 'page.main.signin','value' => 'Войдите'),
            array('id' => '37','lng' => 'en','key' => 'or','value' => 'or'),
            array('id' => '38','lng' => 'ru','key' => 'or','value' => 'или'),
            array('id' => '39','lng' => 'en','key' => 'placeholders.main.email','value' => 'Enter your e-mail'),
            array('id' => '40','lng' => 'ru','key' => 'placeholders.main.email','value' => 'Введите ваш Email'),
            array('id' => '41','lng' => 'en','key' => 'placeholders.main.password','value' => 'Password'),
            array('id' => '42','lng' => 'ru','key' => 'placeholders.main.password','value' => 'Пароль'),
            array('id' => '43','lng' => 'en','key' => 'page.main.forgot','value' => 'Forgot password'),
            array('id' => '44','lng' => 'ru','key' => 'page.main.forgot','value' => 'Забыли пароль'),
            array('id' => '45','lng' => 'en','key' => 'page.main.policy','value' => 'Confidential policy'),
            array('id' => '46','lng' => 'ru','key' => 'page.main.policy','value' => 'Политика конфиденциальности'),
            array('id' => '47','lng' => 'en','key' => 'page.main.buttons.access','value' => 'Get access'),
            array('id' => '48','lng' => 'ru','key' => 'page.main.buttons.access','value' => 'Получить доступ'),
            array('id' => '49','lng' => 'en','key' => 'page.main.buttons.login','value' => 'Log in'),
            array('id' => '50','lng' => 'ru','key' => 'page.main.buttons.login','value' => 'Войти'),
            array('id' => '51','lng' => 'en','key' => 'page.main.buttons.remind','value' => 'Remind password'),
            array('id' => '52','lng' => 'ru','key' => 'page.main.buttons.remind','value' => 'Напомнить пароль'),
            array('id' => '53','lng' => 'en','key' => 'menu.name','value' => 'Menu'),
            array('id' => '54','lng' => 'ru','key' => 'menu.name','value' => 'Меню'),
            array('id' => '55','lng' => 'en','key' => 'page.profile.change_password','value' => 'Change password'),
            array('id' => '56','lng' => 'ru','key' => 'page.profile.change_password','value' => 'Сменить пароль'),
            array('id' => '57','lng' => 'en','key' => 'page.profile.change_photo','value' => 'Change photo'),
            array('id' => '58','lng' => 'ru','key' => 'page.profile.change_photo','value' => 'Сменить фото'),
            array('id' => '59','lng' => 'en','key' => 'page.profile.logout','value' => 'Log out'),
            array('id' => '60','lng' => 'ru','key' => 'page.profile.logout','value' => 'Выйти из профиля'),
            array('id' => '61','lng' => 'en','key' => 'placeholders.name','value' => 'Name'),
            array('id' => '62','lng' => 'ru','key' => 'placeholders.name','value' => 'Имя'),
            array('id' => '63','lng' => 'en','key' => 'placeholders.surname','value' => 'Surname'),
            array('id' => '64','lng' => 'ru','key' => 'placeholders.surname','value' => 'Фамилия'),
            array('id' => '65','lng' => 'en','key' => 'placeholders.city','value' => 'City'),
            array('id' => '66','lng' => 'ru','key' => 'placeholders.city','value' => 'Город'),
            array('id' => '67','lng' => 'en','key' => 'placeholders.email','value' => 'E-Mail'),
            array('id' => '68','lng' => 'ru','key' => 'placeholders.email','value' => 'E-Mail'),
            array('id' => '69','lng' => 'en','key' => 'placeholders.phone','value' => 'Phone'),
            array('id' => '70','lng' => 'ru','key' => 'placeholders.phone','value' => 'Телефон'),
            array('id' => '71','lng' => 'en','key' => 'placeholders.social_link','value' => 'Social network page'),
            array('id' => '72','lng' => 'ru','key' => 'placeholders.social_link','value' => 'Страничка в социальной сети'),
            array('id' => '73','lng' => 'en','key' => 'placeholders.cats_amount','value' => 'How many cats do you have?'),
            array('id' => '74','lng' => 'ru','key' => 'placeholders.cats_amount','value' => 'Сколько у Вас котов?'),
            array('id' => '75','lng' => 'en','key' => 'page.profile.ready','value' => 'Your profile is complete'),
            array('id' => '76','lng' => 'ru','key' => 'page.profile.ready','value' => 'Ваш профиль полностью заполнен')
        ));

    }

}