<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \App\Models\Language::insert([
                [
                    'locale' => 'en',
                    'name' => 'English',
                    'default' => 1,
                    'enabled' => 1,
                ], [
                    'locale' => 'de',
                    'name' => 'German',
                    'default' => 0,
                    'enabled' => 1,
                ], [
                    'locale' => 'fr',
                    'name' => 'French',
                    'default' => 0,
                    'enabled' => 1,
                ]
            ]);
        } catch (\PDOException $exception) {

        }
    }
}
