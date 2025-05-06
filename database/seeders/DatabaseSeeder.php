<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CasasSeeder::class,
            GatosSeeder::class,
            MensajesSeeder::class,
            // TagsSeeder::class,
            // GatoTagSeeder::class,
        ]);

    }
}
