<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初期ユーザーデータの記述
        $users = [
            [
                'username' => 'Atlas一郎',
                'mail' => 'atlas@ichiro.com',
                'password' => Hash::make('atlasichiro1'),
            ],
            [
                'username' => 'Atlas二郎',
                'mail' => 'atlas@jiro.com',
                'password' => Hash::make('atlasjiro2'),
            ],
            [
                'username' => 'Atlas三郎',
                'mail' => 'Atlas@saburo.com',
                'password' => Hash::make('atlassaburo3'),
            ],
        ];

        // データベースにデータを登録
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
