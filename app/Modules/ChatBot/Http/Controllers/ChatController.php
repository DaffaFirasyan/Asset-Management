<?php

namespace App\Modules\ChatBot\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ChatBot\Http\Requests\ChatRequest;
use App\Modules\ChatBot\Services\AssetChatService;
use App\Modules\ChatBot\Transformers\ChatResource;

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