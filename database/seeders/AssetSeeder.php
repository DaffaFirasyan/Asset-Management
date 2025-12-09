<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Macbook Pro M1 13"',
                'serial_number' => 'MBP-2021-001',
                'location' => 'Ruang IT',
                'status' => 'in_use',
                'description' => 'Laptop inventaris untuk Lead Developer.',
            ],
            [
                'name' => 'Macbook Pro M1 13"',
                'serial_number' => 'MBP-2021-002',
                'location' => 'Gudang Lt 2',
                'status' => 'broken',
                'description' => 'Layar retak, menunggu perbaikan vendor.',
            ],
            [
                'name' => 'Proyektor Epson X500',
                'serial_number' => 'EPS-PROJ-005',
                'location' => 'Ruang Meeting Utama',
                'status' => 'available',
                'description' => 'Kondisi prima, remote ada di meja resepsionis.',
            ],
            [
                'name' => 'Kursi Ergonomis Herman Miller',
                'serial_number' => 'CHR-HM-102',
                'location' => 'Ruang HRD',
                'status' => 'in_use',
                'description' => 'Kursi staff HR Manager.',
            ],
            [
                'name' => 'Kamera Sony Alpha a7 III',
                'serial_number' => 'CAM-SON-88',
                'location' => 'Lemari Aset Multimedia',
                'status' => 'available',
                'description' => 'Lengkap dengan lensa kit dan tas.',
            ],
        ];

        foreach ($data as $item) {
            Asset::create($item);
        }
    }
}
