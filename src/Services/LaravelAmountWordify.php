<?php

namespace Swatantra\LaravelAmountWordify\Services;

use Swatantra\LaravelAmountWordify\Helpers\NumberToWordsFormatter;

class LaravelAmountWordify
{
    public function toEnglishWords(int|string $number, ?string $locale = null): string
    {
        $formatter = new NumberToWordsFormatter;

        return trim($formatter->formatNumber($number, $locale));
    }

    public function toNepaliWords(int|string $number): string
    {
        $formatter = new NumberToWordsFormatter;

        return $formatter->formatNumber($number, 'ne');
    }
}
