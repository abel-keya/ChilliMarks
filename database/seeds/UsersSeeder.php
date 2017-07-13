<?php

use Illuminate\Database\Seeder;
use chilliapp\Models\Role;
use chilliapp\Models\User;

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
            'phone'           => '0703436696',
            'password'        =>  bcrypt('password'),
            'from_user'       =>  1
        ]);

        $user->assignRole($adminRole);

        $user = User::create([
            'name'            => 'John Teacher',
            'year'            => '2017',
            'phone'           => '0703436696',
            'password'        =>  bcrypt('password'),
            'from_user'       =>  1
        ]);

        $user->assignRole($teacherRole);

        $user = User::create([
            'name'            => 'Jane Student',
            'year'            => '2017',
            'phone'           => '0703436696',
            'password'        =>  bcrypt('password'),
            'from_user'       =>  1
        ]);

        $user->assignRole($studentRole);
    }
}
