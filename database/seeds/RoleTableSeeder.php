<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = new Role();
        $admin->name         = 'administrator';
        $admin->display_name = 'Administrator'; // optional
        $admin->description  = ''; // optional
        $admin->save();

        $customer = new Role();
        $customer->name         = 'customer';
        $customer->display_name = 'Customer'; // optional
        $customer->description  = ''; // optional
        $customer->save();
        
    }
}
