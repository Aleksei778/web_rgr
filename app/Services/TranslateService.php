<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LibreTranslateService
{
    private $baseUrl;

    public function __construct()
    {
        // Используйте публичный сервер или свой собственный
        $this->baseUrl = 'https://libretranslate.de';
    }

    /**
     * Перевести текст
     */
    public function translate(string $text, string $targetLanguage, string $sourceLanguage = 'auto')
    {
        try {
            $response = Http::post($this->baseUrl . '/translate', [
                'q' => $text,
                'source' => $sourceLanguage,
                'target' => $targetLanguage,
                'format' => 'text'
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return [
                    'success' => true,
                    'translated_text' => $result['translatedText'],
                    'detected_language' => $result['detectedLanguage'] ?? null,
                ];
            }

            return [
                'success' => false,
                'error' => 'Translation failed: ' . $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('LibreTranslate Exception', ['message' => $e->getMessage()]);
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Получить поддерживаемые языки
     */
    public function getSupportedLanguages()
    {
        try {
            $response = Http::get($this->baseUrl . '/languages');
            
            if ($response->successful()) {
                return [
                    'success' => true,
                    'languages' => $response->json()
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to get languages'
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Определить язык
     */
    public function detectLanguage(string $text)
    {
        try {
            $response = Http::post($this->baseUrl . '/detect', [
                'q' => $text
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return [
                    'success' => true,
                    'language' => $result[0]['language'] ?? null,
                    'confidence' => $result[0]['confidence'] ?? null
                ];
            }

            return [
                'success' => false,
                'error' => 'Detection failed'
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}