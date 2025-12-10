<?php

namespace App\Modules\Asset\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Asset\Services\AssetService;
use Illuminate\Http\Request;

class AssetController extends Controller {
    protected $service;
    public function __construct(AssetService $service) {
        $this->service = $service;
    }

    public function index() {
        $assets = $this->service->getAllAssets();
        return view('assets.index', compact('assets'));
    }

    public function create() {
        return view('assets.create');
    }

    public function store(Request $request) {
        // Validasi sederhana (Best practice: Pindahkan ke FormRequest)
        $data = $request->validate([
            'name' => 'required',
            'serial_number' => 'required|unique:assets',
            'location' => 'required',
            'status' => 'required',
            'description' => 'nullable'
        ]);

        $this->service->storeAsset($data);
        return redirect()->route('assets.index')->with('success', 'Aset Berhasil Disimpan!');
    }

    public function show($id) {
        $asset = $this->service->getAssetById($id);
        return view('assets.show', compact('asset'));
    }

    public function edit($id) {
        $asset = $this->service->getAssetById($id);
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'name' => 'required',
            'serial_number' => 'required|unique:assets,serial_number,' . $id,
            'location' => 'required',
            'status' => 'required',
            'description' => 'nullable'
        ]);

        $this->service->updateAsset($id, $data);
        return redirect()->route('assets.index')->with('success', 'Aset Berhasil Diupdate!');
    }

    public function destroy($id) {
        $this->service->deleteAsset($id);
        return redirect()->route('assets.index')->with('success', 'Aset Berhasil Dihapus!');
    }
}