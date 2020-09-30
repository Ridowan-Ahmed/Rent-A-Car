<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('companies')->get()->count() == 0){

            DB::table('companies')->insert([
                [
                    'user_id' => 2,
                    'name' => 'Beximco',
                    'slug' => 'beximco',
                    'photo_id' => 3,
                    'address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'phone_num' => '01820213153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 2,
                    'name' => 'Ericsson',
                    'slug' => 'ericsson',
                    'photo_id' => 1,
                    'address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'phone_num' => '01820213153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            echo "Company seed complete\n";
        } else {
            echo "Company table is not empty\n";
        }
    }
}
