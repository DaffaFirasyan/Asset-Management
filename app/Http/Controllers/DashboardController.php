<?php

namespace App\Http\Controllers;

use App\Modules\Asset\Models\Asset;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik sederhana
        $total = Asset::count();
        $available = Asset::where('status', 'available')->count();
        $broken = Asset::where('status', 'broken')->count();
        $inUse = Asset::where('status', 'in_use')->count();
        
        // Ambil 5 aset terbaru
        $recentAssets = Asset::latest()->take(5)->get();

        return view('dashboard', compact('total', 'available', 'broken', 'inUse', 'recentAssets'));
    }
}