<?php

namespace Database\Seeders;

use App\Models\ItemPajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemPajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemPajak::create([
            'item_id' => 1,
            'pajak_id' => 1
        ]);
        ItemPajak::create([
            'item_id' => 1,
            'pajak_id' => 2
        ]);
    }
}
