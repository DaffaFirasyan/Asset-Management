<?php

namespace App\Modules\Asset\Services;

use App\Modules\Asset\Repositories\AssetRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AssetChatService
{
    protected $repository;

    public function __construct(AssetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function processChat(string $userMessage)
    {
        try {
            // 1. Ambil Data Context dari Repository
            // Sesuai prinsip Clean Architecture: Service minta data ke Repository
            $assets = $this->repository->getAllAssetsForContext();

            // 2. Susun System Prompt (Otak & Pengetahuan AI)
            // Kita berikan "Kepribadian" dan "Data" ke AI
            $systemContent = "Anda adalah Asisten Manajer Aset Profesional bernama 'AssetBot'. \n" .
                "Tugas anda adalah menjawab pertanyaan terkait stok dan status aset kantor. \n\n" .
                
                "ATURAN FORMAT JAWABAN (WAJIB): \n" .
                "1. Jika menyebutkan data aset, GUNAKAN FORMAT DAFTAR (BULLET POINTS). \n" .
                "2. Gunakan tanda bintang dua (**) untuk menebalkan Nama Barang dan Status. \n" .
                "3. Jangan menulis dalam satu paragraf panjang. \n" .
                "4. Contoh format yang diinginkan: \n" .
                "   - **Nama Barang** (Lokasi): Status \n\n" . // Memberi contoh ke AI biar paham
                
                "Gunakan data berikut sebagai referensi fakta: \n" .
                json_encode($assets) . "\n\n" .
                "Jika barang tidak ada, katakan jujur.";

            // 3. Tembak API Groq (Infrastructure Layer)
            $response = Http::withToken(env('GROQ_API_KEY'))
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    // GANTI BARIS INI:
                    'model' => 'llama-3.3-70b-versatile', 
                    
                    'messages' => [
                        ['role' => 'system', 'content' => $systemContent],
                        ['role' => 'user', 'content' => $userMessage],
                    ],
                    'temperature' => 0.5,
                ]);

            // 4. Cek apakah request berhasil?
            if ($response->failed()) {
                Log::error('Groq API Error: ' . $response->body());
                return "Maaf, server otak saya sedang gangguan. Silakan coba lagi nanti.";
            }

            // 5. Ambil isi pesan dari response JSON Groq
            return $response->json()['choices'][0]['message']['content'];

        } catch (\Exception $e) {
            // Tangkap error jika koneksi internet mati dll
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan teknis pada sistem.";
        }
    }
}