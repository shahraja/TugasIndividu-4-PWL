<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private $data = [
        [
            'tipe' => 'Acer Predator Helios 300',
            'kategori' => 'Gaming',
            'merek' => 'Acer',
            'harga' => 'Rp. 21.999.000'
        ],
        [
            'tipe' => 'Acer Nitro 5',
            'kategori' => 'Gaming',
            'merek' => 'Acer',
            'harga' => 'Rp. 16.749.000'
        ],
        [
            'tipe' => 'Asus ROG Flow Z13',
            'kategori' => 'Gaming',
            'merek' => 'Asus',
            'harga' => 'Rp. 16.099.000'
        ],
        [
            'tipe' => 'Asus ROG Strix Scar',
            'kategori' => 'Gaming',
            'merek' => 'Asus',
            'harga' => 'Rp. 25.799.000'
        ],
        [
            'tipe' => 'Asus Tuf Dash F15',
            'kategori' => 'Gaming',
            'merek' => 'Asus',
            'harga' => 'Rp. 14.099.000'
        ],
        [
            'tipe' => 'Dell Alienware x14',
            'kategori' => 'Gaming',
            'merek' => 'Dell',
            'harga' => 'Rp. 18.199.000'
        ],
        [
            'tipe' => 'Dell G15',
            'kategori' => 'Gaming',
            'merek' => 'Dell',
            'harga' => 'Rp. 10.949.000'
        ],
        [
            'tipe' => 'HP Omen 16',
            'kategori' => 'Gaming',
            'merek' => 'Hp',
            'harga' => 'Rp. 19.254.000'
        ],
        [
            'tipe' => 'Lenovo Legion 5i Pro',
            'kategori' => 'Gaming',
            'merek' => 'Lenovo',
            'harga' => 'Rp. 23.399.000'
        ],
        [
            'tipe' => 'MSI Katana GF66/76',
            'kategori' => 'Gaming',
            'merek' => 'MSI',
            'harga' => 'Rp. 9.476.000'
        ],
    ];
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        foreach ($this -> data as $data) {
            \App\Models\Laptop::factory() -> create($data);
        }
    }
}
