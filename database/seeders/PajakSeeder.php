<?php

namespace Database\Seeders;

use App\Models\Pajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pajak::create([
            'nama' => 'pph',
            'rate' => 0.05
        ]);
        Pajak::create([
            'nama' => 'pajak toko',
            'rate' => 0.1
        ]);
    }
}
