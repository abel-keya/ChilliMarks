<?php

use Illuminate\Database\Seeder;
use chilliapp\Models\Subject;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->delete(); 

        Subject::create([
            'name'      => 'Mathematics',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'English',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Kiswahili',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Science',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Social Studies',
            'from_user' => 1
        ]);

    }
}
