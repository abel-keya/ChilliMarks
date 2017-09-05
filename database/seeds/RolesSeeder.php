<?php

use Illuminate\Database\Seeder;
use chillimarks\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        Role::create([
            'name' => 'superadmin'
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'teacher'
        ]);

        Role::create([
            'name' => 'student'
        ]);
    }
}
