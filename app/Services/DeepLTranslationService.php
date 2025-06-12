<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DeepLTranslationService
{
    protected string $apiKey;
    protected string $apiUrl = 'https://api-free.deepl.com/v2/translate';

    public function __construct()
    {
        $this->apiKey = config('services.deepl.key');
    }

    /**
     * Translate text to target language
     */
    public function translate(string $text, string $source, string $target): string
    {
        if (empty($text)) {
            return $text;
        }

        $cacheKey = 'deepl_' . md5($text . $source . $target);

        return Cache::remember($cacheKey, 86400, function () use ($text, $source, $target) {
            $response = Http::asForm()
                ->timeout(10)
                ->post($this->apiUrl, [
                    'auth_key' => $this->apiKey,
                    'text' => $text,
                    'source_lang' => strtoupper($source),
                    'target_lang' => strtoupper($target),
                ]);

            return $response->json()['translations'][0]['text'] ?? $text;
        });
    }

    /**
     * Translate multiple texts at once
     */
    public function translateArray(array $texts, string $source, string $target): array
    {
        if (empty($texts)) {
            return [];
        }

        $response = Http::asForm()
            ->timeout(10)
            ->post($this->apiUrl, [
                'auth_key' => $this->apiKey,
                'text' => $texts,
                'source_lang' => strtoupper($source),
                'target_lang' => strtoupper($target),
            ]);

        $translations = $response->json()['translations'] ?? [];

        $results = [];
        foreach ($texts as $index => $text) {
            $results[$index] = $translations[$index]['text'] ?? $text;
        }

        return $results;
    }
}
