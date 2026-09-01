<?php

namespace App\Services;


use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;




class ChatbotService
{
    /**
     * Send user prompt to Groq AI API and get the response.
     */
   
    public function askGemini(string $userPrompt): string
    {
        // Get the Groq API key from .env file
        $apiKey = env('GROQ_API_KEY');

        // Fetch car categories that currently have available cars in the DB
        $availableCategories = Category::whereHas('cars')->pluck('name')->implode(', ');

        // Define system instructions and context rules for the AI model
        $systemInstruction = "You are 'CarRental' AI assistant. "
            . "Rules:\n"
            . "1. Answer ONLY the user's specific question concisely using the context below.\n"
            . "2. Do NOT list all rules/cars unless explicitly asked.\n"
            . "3. Do NOT use markdown bold syntax like '**'. Keep text clean and plain.\n"
            . "4. Answer in the same language as the user query.\n\n"
            . "Context Data:\n"
            . "- Available Cars: " . ($availableCategories ?: 'Sedan, SUV, Economy') . "\n"
            . "- Required Docs: ID/Passport, Driver License, Credit Card\n"
            . "- Min Age: 21 years\n"
            . "- Min Duration: 1 day\n"
            . "- Fuel Policy: Same-to-Same";

        try {
            // Send direct HTTP POST request to Groq API with 10 seconds timeout
            $response = Http::withToken($apiKey)
                ->timeout(10)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'openai/gpt-oss-120b',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemInstruction],
                        ['role' => 'user', 'content' => $userPrompt]
                    ],
                    'temperature' => 0.3, //to give strict answers
                ]);

                // If request succeeded, return the message content
            if ($response->successful()) {
                return $response->json()['choices'][0]['message']['content'];
            }

            // Log API error response if request failed
            Log::error("Groq API error: " . $response->body());
        } catch (\Throwable $e) {
            // Catch and log any connection exceptions
            Log::error("Groq Exception: " . $e->getMessage());
        }

        // Fallback message when the service is unavailable
        return 'The AI service is currently unavailable. Please try again.';
    }
}
