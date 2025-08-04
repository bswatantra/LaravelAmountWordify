<?php

namespace Swatantra\LaravelAmountWordify\Helpers;

use Illuminate\Support\Facades\Config;

class NumberToWordsFormatter
{
    private array $ones = [];

    private array $tens = [];

    private array $units = [];

    private string $andWord = '';

    private string $onlyWord = '';

    private array $compound = [];

    public function __construct()
    {
        $locale = Config::get('number_to_words.locale', 'en');
        $this->loadLocaleWords($locale);
    }

    public function formatNumber($num, ?string $locale = null): string
    {
        $locale = $locale ?? Config::get('number_to_words.locale', 'en');
        $this->loadLocaleWords($locale);

        $num = (string) preg_replace('/[^0-9]/', '', $num);

        if (strlen($num) > 9) {
            return 'overflow';
        }

        $num = str_pad($num, 9, '0', STR_PAD_LEFT);

        $crore = (int) substr($num, 0, 2);
        $lakh = (int) substr($num, 2, 2);
        $thousand = (int) substr($num, 4, 2);
        $hundred = (int) substr($num, 6, 1);
        $lastTwo = (int) substr($num, 7, 2);

        $str = '';

        if ($crore > 0) {
            $str .= $this->parseNumber($crore).$this->units[0];
        }
        if ($lakh > 0) {
            $str .= $this->parseNumber($lakh).$this->units[1];
        }
        if ($thousand > 0) {
            $str .= $this->parseNumber($thousand).$this->units[2];
        }
        if ($hundred > 0) {
            $str .= $this->ones[$hundred].$this->units[3];
        }
        if ($lastTwo > 0) {
            if ($str !== '') {
                $str .= $this->andWord;
            }
            if ($locale === 'ne' && $lastTwo >= 20) {
                $str .= $this->parseNepaliCompound($lastTwo);
            } else {
                $str .= $this->parseNumber($lastTwo);
            }
        }

        $str = trim($str);
        if ($str !== '') {
            $str .= ' '.$this->onlyWord;
        }
        return $str;
    }

    private function loadLocaleWords(string $locale): void
    {
        $words = Config::get("number_to_words.words.$locale",'en');

        $this->ones = $words['ones'] ?? [];
        $this->tens = $words['tens'] ?? [];
        $this->units = $words['units'] ?? [];
        $this->andWord = $words['and_word'] ?? 'and ';
        $this->onlyWord = $words['only'] ?? 'only';
        $this->compound = $words['compound'] ?? [];
    }

    private function parseNumber(int $num): string
    {
        if ($num < 20) {
            return $this->ones[$num] ?? '';
        }

        $tens = (int) floor($num / 10);
        $ones = $num % 10;

        return trim(($this->tens[$tens] ?? '').($this->ones[$ones] ?? '')).' ';
    }

    private function parseNepaliCompound(int $num): string
    {
        return $this->compound[$num] ?? $this->parseNumber($num);
    }
}
