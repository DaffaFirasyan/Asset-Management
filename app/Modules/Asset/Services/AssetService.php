<?php
namespace App\Modules\Asset\Services;
use App\Modules\Asset\Repositories\AssetRepository;

class AssetService {
    protected $repo;
    public function __construct(AssetRepository $repo) {
        $this->repo = $repo;
    }
    public function getAllAssets() {
        return $this->repo->getAll();
    }
    public function storeAsset($data) {
        return $this->repo->create($data);
    }
    public function getAssetById($id) {
        return $this->repo->findById($id);
    }
    public function updateAsset($id, $data) {
        return $this->repo->update($id, $data);
    }
    public function deleteAsset($id) {
        return $this->repo->delete($id);
    }
}