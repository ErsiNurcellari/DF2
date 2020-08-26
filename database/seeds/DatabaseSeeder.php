<?php

use Illuminate\Database\Seeder;
use App\Models\Seeder as ModelSeeder;
use Illuminate\Support\Facades\File as SFile;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (DB::table('users')->count() == 0)  {
            $this->call(RoleTableSeeder::class);
            $this->call(PermissionTableSeeder::class);
            $this->call(TermTableSeeder::class);
            $this->call(UserTableSeeder::class);
            $this->call(FormTableSeeder::class);
            $this->call(ServiceTableSeeder::class);
            $this->call(EmailTemplateTableSeeder::class);
            $this->call(LanguageTableSeeder::class);
            $this->call(LanguagePhraseTableSeeder::class);
            $this->call(SettingsTableSeeder::class);
            $this->call(LanguagePhraseTableSeederV1::class);

            ModelSeeder::create(['name' => 'RoleTableSeeder']);
            ModelSeeder::create(['name' => 'PermissionTableSeeder']);
            ModelSeeder::create(['name' => 'TermTableSeeder']);
            ModelSeeder::create(['name' => 'UserTableSeeder']);
            ModelSeeder::create(['name' => 'FormTableSeeder']);
            ModelSeeder::create(['name' => 'ServiceTableSeeder']);
            ModelSeeder::create(['name' => 'EmailTemplateTableSeeder']);
            ModelSeeder::create(['name' => 'LanguageTableSeeder']);
            ModelSeeder::create(['name' => 'LanguagePhraseTableSeeder']);
            ModelSeeder::create(['name' => 'SettingsTableSeeder']);
            ModelSeeder::create(['name' => 'LanguagePhraseTableSeederV1']);

            return;
        }

        // VERSION 1.0 PATCH
        if( DB::table('seeders')->count() == 0 ) {

            $this->call(LanguageTableSeeder::class);
            $this->call(LanguagePhraseTableSeeder::class);
            $this->call(LanguagePhraseTableSeederV1::class);

            ModelSeeder::create(['name' => 'RoleTableSeeder']);
            ModelSeeder::create(['name' => 'PermissionTableSeeder']);
            ModelSeeder::create(['name' => 'TermTableSeeder']);
            ModelSeeder::create(['name' => 'UserTableSeeder']);
            ModelSeeder::create(['name' => 'FormTableSeeder']);
            ModelSeeder::create(['name' => 'ServiceTableSeeder']);
            ModelSeeder::create(['name' => 'EmailTemplateTableSeeder']);
            ModelSeeder::create(['name' => 'LanguageTableSeeder']);
            ModelSeeder::create(['name' => 'LanguagePhraseTableSeeder']);
            ModelSeeder::create(['name' => 'SettingsTableSeeder']);
            ModelSeeder::create(['name' => 'LanguagePhraseTableSeederV1']);

            return;
        }


        // Update here.
        $seeders = SFile::files(database_path('seeds'));

        if(sizeof($seeders) > 0) {
            // get files name in array
            $seeders_files = collect($seeders)->map(function ($file) {
                return $file->getFilenameWithoutExtension();
            });

            foreach ($seeders_files as $seeder) {
                if($seeder == 'DatabaseSeeder') {
                    continue;
                }

                // CHECK if seeder has already ran.
                if (ModelSeeder::where('name', $seeder)->count()) {
                    continue;
                }

                // Run seeder and insert into Seeder table for versioning.
                $class = new $seeder();
                $class->run();

                ModelSeeder::create(['name' => $seeder]);
            }
        }
    }

}
