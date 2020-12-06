<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
                ->insert([
                    'name' => 'Kelompok 3',
                    'phone_number_account' => '086632548665',
                    'email' => 'Kelompok3@admin.com',
                    'password' => '$2b$10$z7LQ0ijrQZozhRkEaDT0gu7.caYSnxjmS/CAZuAUM00nhOOXc3SB6',//kelompok3
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ]);

                
    }
}
