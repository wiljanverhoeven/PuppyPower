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

        Training::factory(3)->create();

        Product::factory()->count(20)->create();

        //pluck all training ids
        $trainingIds = Training::pluck('training_id')->toArray();

        Module::factory(12)->create([
            'training_id' => function () use ($trainingIds) {
                return $trainingIds[array_rand($trainingIds)];
            },
        ]);

        // Pluck all module ids
        $moduleIds = Module::pluck('module_id')->toArray();

        Media::factory(30)->create([
            'module_id' => function () use ($moduleIds) {
                return $moduleIds[array_rand($moduleIds)];
            },
        ]);
    }
}
