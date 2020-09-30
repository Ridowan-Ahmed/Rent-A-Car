<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->get()->count() == 0){

            DB::table('users')->insert([
                [
                    'name' => 'Ridowan Ahmed',
                    'slug' => 'ridowan_ahmed',
                    'email' => 'ridowan1993@gmail.com',
                    'role_id' => 1,
                    'photo_id' => 1,
                    'password' => bcrypt('19951995'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Kamrul Hassan',
                    'slug' => 'kamrul_hassan',
                    'role_id' => 2,
                    'photo_id' => 2,
                    'email' => 'kamrul.aktel@gmail.com',
                    'password' => bcrypt('12345678'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            echo "User seed complete\n";
        } else {
            echo "User table is not empty\n";
        }
    }
}
