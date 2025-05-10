<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatBotController extends Controller
{
    public function sendChat(Request $request)
    {
        $apiKey = env('GOOGLE_GEMINI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $request->input],
                    ]
                ]
            ]
        ]);

        if ($response->failed()) {
            dd($response->status(), $response->body());
        }

        $result = $response->json();
        $output = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';

        return $output;
    }
}
