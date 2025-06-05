<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;
use Parsedown;

class GeminiService
{
    public function ask(string $prompt): string
    {
        $result = Gemini::geminiFlash("gemini-2.0-flash")
            ->generateContent($prompt);

        $parsedown = new Parsedown();
        $parsedown->setSafeMode(true); // Hindari XSS
        return $parsedown->text($result->text());
    }
}
