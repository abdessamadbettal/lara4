<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clean the public folder in storage
        $this->cleanStorageMediaFolder();

        // call user seeder
         $this->call([
            RolesAndPermissionsSeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            PhoneSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            // CustomFieldSeeder::class,
            // FaqSeeder::class,
            // ReviewSeeder::class,
        ]);

    }


            /**
     * Clean the public folder in storage.
     */
    protected function cleanStorageMediaFolder(): void
    {
        $mediaFolder = storage_path('app/public/media');

        if (File::exists($mediaFolder)) {
            File::cleanDirectory($mediaFolder);
        }
    }
}
