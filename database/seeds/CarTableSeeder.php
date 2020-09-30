<?php

use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('cars')->get()->count() == 0){

            DB::table('cars')->insert([
                [
                    'owner_id' => 1,
                    'company_id' => 1,
                    'registration_num' => 'D.M.TA-11-8168',
                    'brand_id' => 1,
                    'model_no' => '2015',
                    'parking_mode' => 'owner',
                    'tax_token_expiry_date' => '2019-01-19',
                    'fitness_expiry_date' => '2019-03-29',
                    'insurance_expiry_date' => '2019-04-11',
                    'road_permit_expiry_date' => '2019-03-12',
                    'driver_name' => 'Karim Ali',
                    'driver_duty' => 8,
                    'driver_nid' => '1993122456789',
                    'driver_address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'driver_phone_num' => '01832413153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'owner_id' => 2,
                    'company_id' => 1,
                    'registration_num' => 'D.M.TA-11-8368',
                    'brand_id' => 2,
                    'model_no' => '2015',
                    'parking_mode' => 'owner',
                    'tax_token_expiry_date' => '2019-01-19',
                    'fitness_expiry_date' => '2019-03-29',
                    'insurance_expiry_date' => '2019-04-11',
                    'road_permit_expiry_date' => '2019-03-12',
                    'driver_name' => 'Rahim Ali',
                    'driver_duty' => 8,
                    'driver_nid' => '1993129456789',
                    'driver_address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'driver_phone_num' => '01820219153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'owner_id' => 1,
                    'company_id' => 2,
                    'registration_num' => 'D.M.TA-11-8468',
                    'brand_id' => 3,
                    'model_no' => '2015',
                    'parking_mode' => 'company',
                    'tax_token_expiry_date' => '2019-01-19',
                    'fitness_expiry_date' => '2019-10-29',
                    'insurance_expiry_date' => '2019-11-11',
                    'road_permit_expiry_date' => '2019-03-12',
                    'driver_name' => 'Abdul Mia',
                    'driver_duty' => 10,
                    'driver_nid' => '1990123456789',
                    'driver_address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'driver_phone_num' => '01820223153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'owner_id' => 1,
                    'company_id' => 1,
                    'registration_num' => 'D.M.RA-11-8568',
                    'brand_id' => 1,
                    'model_no' => '2015',
                    'parking_mode' => 'owner',
                    'tax_token_expiry_date' => '2019-09-19',
                    'fitness_expiry_date' => '2019-03-05',
                    'insurance_expiry_date' => '2019-12-11',
                    'road_permit_expiry_date' => '2019-03-12',
                    'driver_name' => 'Mrinal Knati',
                    'driver_duty' => 8,
                    'driver_nid' => '1993123456789',
                    'driver_address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'driver_phone_num' => '01920213153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'owner_id' => 1,
                    'company_id' => 2,
                    'registration_num' => 'D.M.TA-11-8158',
                    'brand_id' => 2,
                    'model_no' => '2015',
                    'parking_mode' => 'company',
                    'tax_token_expiry_date' => '2019-01-19',
                    'fitness_expiry_date' => '2019-03-29',
                    'insurance_expiry_date' => '2019-04-11',
                    'road_permit_expiry_date' => '2019-03-12',
                    'driver_name' => 'Kuddhus Mia',
                    'driver_duty' => 10,
                    'driver_nid' => '1993123456780',
                    'driver_address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'driver_phone_num' => '01820213154',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'owner_id' => 2,
                    'company_id' => 1,
                    'registration_num' => 'D.M.TA-11-8163',
                    'brand_id' => 1,
                    'model_no' => '2015',
                    'parking_mode' => 'owner',
                    'tax_token_expiry_date' => '2019-03-19',
                    'fitness_expiry_date' => '2019-02-28',
                    'insurance_expiry_date' => '2019-06-11',
                    'road_permit_expiry_date' => '2019-03-30',
                    'driver_name' => 'Shuroz Mia',
                    'driver_duty' => 10,
                    'driver_nid' => '1993123452789',
                    'driver_address' => 'Plot 15, Block B, Bashundhara, Dhaka 1229',
                    'driver_phone_num' => '01820213153',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
            echo "Car table seed complete\n";
        } else {
            echo "\e[Table is not empty, therefore NOT\n";
        }
    }
}
