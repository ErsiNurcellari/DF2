<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perm = new Permission();
        $perm->name         = 'manage-products';
        $perm->display_name = 'Manage Products'; // optional
        $perm->description  = ''; // optional
        $perm->save();
    }
}
