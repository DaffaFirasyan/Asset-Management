<?php

namespace App\Modules\Asset\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'meta' => [
                'status' => 'success',
                'code' => 200,
                'timestamp' => now()->toDateTimeString(),
            ],
            'data' => [
                'reply' => $this->resource,
            ],
        ];
    }
}