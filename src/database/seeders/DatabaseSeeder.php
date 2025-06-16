<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Product;
use App\Models\User;
use App\Models\Training;
use App\Models\Module;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);

        User::factory()->create([
            'name' => 'admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
        ]);


        Training::factory(5)->create();

        Product::factory()->count(20)->create();

// Pluck all training IDs
        $trainingIds = Training::pluck('training_id')->toArray();

        Module::factory(12)->create([
            'training_id' => function () use ($trainingIds) {
                return $trainingIds[array_rand($trainingIds)];
            },
        ]);

// Pluck all module IDs
        $moduleIds = Module::pluck('module_id')->toArray();

        Media::factory(30)->create([
            'module_id' => function () use ($moduleIds) {
                return $moduleIds[array_rand($moduleIds)];
            },
            'path' => function () {
                return rand(0, 1)
                    ? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ&list=RDdQw4w9WgXcQ&start_radio=1'
                    : 'media_images/images.jpg';
            },
        ]);
    }
}
