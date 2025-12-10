<?php

namespace App\Modules\Asset\Repositories;

use App\Modules\Asset\Models\Asset;

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

    public function create(array $data) {
        return Asset::create($data);
    }
    
    public function getAll() {
        return Asset::latest()->get(); 
    }

    public function findById($id) {
        return Asset::findOrFail($id);
    }

    public function update($id, array $data) {
        $asset = Asset::findOrFail($id);
        $asset->update($data);
        return $asset;
    }

    public function delete($id) {
        $asset = Asset::findOrFail($id);
        return $asset->delete();
    }
}