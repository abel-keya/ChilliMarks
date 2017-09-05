<?php

use Illuminate\Database\Seeder;
use chillimarks\Models\Subject;

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
            'abbr'      => 'MATHS',
            'code'      => 'MATHS',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'English',
            'abbr'      => 'ENG',
            'code'      => 'ENG',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Kiswahili',
            'abbr'      => 'KISWA',
            'code'      => 'KISWA',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Science',
            'abbr'      => 'SCI',
            'code'      => 'SCI',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Social Studies',
            'abbr'      => 'S.S',
            'code'      => 'S.S',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Christian Religious Education',
            'abbr'      => 'C.R.E',
            'code'      => 'C.R.E',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Islamic Religious Education',
            'abbr'      => 'I.R.E',
            'code'      => 'I.R.E',
            'from_user' => 1
        ]);

        Subject::create([
            'name'      => 'Hindu Religious Education',
            'abbr'      => 'H.R.E',
            'code'      => 'H.R.E',
            'from_user' => 1
        ]);

    }
}
