<?php

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        EmailTemplate::create([
            'name' => 'order_created',
            'subject' => 'Thank you for order',
             'content' => 'Your order has been submitted. A staff member will take a look shortly.',
        ]);
    }
}
