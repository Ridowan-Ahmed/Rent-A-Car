<?php

use Illuminate\Database\Seeder;

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('owners')->get()->count() == 0){

            DB::table('owners')->insert([
                [
                    'user_id' => 2,
                    'name' => 'Boshir Mia',
                    'slug' => 'boshir_mia',
                    'address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'phone_num' => '01820213153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 2,
                    'name' => 'Mahmudul Hassan',
                    'slug' => 'mahmudul_hassan',
                    'address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'phone_num' => '01820213153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            echo "Owner seed complete\n";
        } else {
            echo "Owner table is not empty\n";
        }
    }
}
