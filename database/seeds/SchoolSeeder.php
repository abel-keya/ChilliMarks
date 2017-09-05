<?php

use Illuminate\Database\Seeder;
use chillimarks\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school')->delete(); 

        School::create([
            'name'      => 'ChilliMarks School',
            'address'   => 'P.O. Box 12345 - 00100, Nairobi, Kenya.',
            'phone'     => '+254 703 333 231',
            'from_user' => 1
        ]);
    }
}
