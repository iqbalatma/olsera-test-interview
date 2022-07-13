<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemPajak;
use App\Models\Pajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PajakSeeder::class,
            ItemSeeder::class,
            ItemPajakSeeder::class,
        ]);
    }
}
