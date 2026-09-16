<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreChatbotMessageRequest;
use App\Services\ChatbotService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    use ApiResponse;

    protected ChatbotService $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function message(StoreChatbotMessageRequest $request): JsonResponse
    {
        $userPrompt = $request->validated('message');

        $botReply = $this->chatbotService->askAi($userPrompt);

        return $this->successResponse([
            'reply' => $botReply,
        ], 'Message processed successfully');
    }
}
