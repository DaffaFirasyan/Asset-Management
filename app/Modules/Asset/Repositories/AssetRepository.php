<?php

namespace App\Modules\Asset\Repositories;

use App\Models\Asset;

class AssetRepository
{
    /**
     * Mengambil data aset untuk konteks AI.
     * Kita hanya mengambil kolom penting untuk menghemat token AI nanti.
     */
    public function getAllAssetsForContext()
    {
        return Asset::select('name', 'serial_number', 'location', 'status', 'description')
                    ->get();
    }
}