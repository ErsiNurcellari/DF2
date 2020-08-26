<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin_role = Role::where('name', 'administrator')->first();
        
        $admin = User::create([
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => bcrypt('temp'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        $admin->roles()->attach($admin_role);

        $admin = User::create([
            'email' => 'demo@demo.com',
            'username' => 'demo',
            'password' => bcrypt('demo'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $admin->roles()->attach($admin_role);

        $cus_role = Role::where('name', 'customer')->first();

        $cus = User::create([
            'email' => 'c@c.com',
            'username' => 'customer',
            'password' => bcrypt('temp'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $cus->roles()->attach($cus_role);
    }
}
