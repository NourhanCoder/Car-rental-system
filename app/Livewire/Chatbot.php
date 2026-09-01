<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ChatbotService;

class Chatbot extends Component
{
    // Toggle state for opening/closing chat window
    public bool $isOpen = false;

    // Connect the input field to the user's message
    public string $userMessage = '';

    // Array storing active conversation history
    public array $messages = [];

    /**
     * Fetch message history from session or set default welcome message
     */
    public function mount(): void
    {
        
        $this->messages = session()->get('chatbot_messages', [
            [
                'sender' => 'bot',
                'text' => 'Hello! Welcome to CarRental. How can I assist you today?'

            ]

        ]);
    }

    /**
     * Toggle visibility of the chat window.
     */
    public function toggleChat(): void
    {
        $this->isOpen = !$this->isOpen;
    }


    /**
     * Handle sending user message and retrieving AI response.
     */
    public function sendMessage(ChatbotService $chatbotService): void
    {
        // Ignore empty or whitespace-only messages
        if (trim($this->userMessage) === '') {
            return;
        }

        // 1. Add the user's message
        $this->messages[] = [
            'sender' => 'user',
            'text' => $this->userMessage
        ];

        $prompt = $this->userMessage;
        $this->userMessage = ''; // Clear input field

        // 2. Get AI response from ChatbotService
        $aiResponse = $chatbotService->askGemini($prompt);

        // 3. Add the bot response to local state
        $this->messages[] = [
            'sender' => 'bot',
            'text' => $aiResponse
        ];

        // 4. Save updated conversation to session
        session()->put('chatbot_messages', $this->messages);
    }

    /**
     * Render the Livewire component view.
     */
    public function render()
    {
        return view('livewire.chatbot');
    }
}
