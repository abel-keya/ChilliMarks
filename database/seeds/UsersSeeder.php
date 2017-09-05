<?php

use Illuminate\Database\Seeder;
use chillimarks\Models\Role;
use chillimarks\Models\User;
use chillimarks\Models\Admission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete(); 

        $superadminRole       = Role::whereName('superadmin')->first();
        
        $adminRole            = Role::whereName('admin')->first();

        $teacherRole          = Role::whereName('teacher')->first();
        
        $studentRole          = Role::whereName('student')->first();

        $user = User::create([
            'name'            => 'John Doe',
            'year'            => '2017',
            'phone'           => '0703436696',
            'password'        =>  bcrypt('password'),
            'from_user'       =>  1
        ]);

        $user->assignRole($superadminRole);

        $user = User::create([
            'name'            => 'Theresa Admin',
            'year'            => '2017',
            'phone'           => '0703436697',
            'password'        =>  bcrypt('password'),
            'from_user'       =>  1
        ]);

        $user->assignRole($adminRole);

        $user = User::create([
            'name'            => 'John Teacher',
            'year'            => '2017',
            'phone'           => '0703436698',
            'password'        =>  bcrypt('password'),
            'from_user'       =>  1
        ]);

        $user->assignRole($teacherRole);

        $user = User::create([
            'name'            => 'Jane Student',
            'year'            => '2017',
            'phone'           => '0703436699',
            'password'        =>  bcrypt('password'),
            'from_user'       =>  1
        ]);

        Admission::create([
            'user_id'         => 4,
            'adm_no'          => '323',
            'from_user'       => 1
        ]);

        $user->assignRole($studentRole);
    }
}
