<?php

namespace App\Modules\Asset\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Asset\Http\Requests\ChatRequest;
use App\Modules\Asset\Services\AssetChatService;
use App\Modules\Asset\Transformers\ChatResource;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(AssetChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function send(ChatRequest $request)
    {
        $message = $request->validated()['message'];

        $response = $this->chatService->processChat($message);

        return new ChatResource($response);
    }
}