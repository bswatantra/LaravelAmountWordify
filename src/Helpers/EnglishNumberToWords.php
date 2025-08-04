<?php

namespace Swatantra\LaravelAmountWordify\Helpers;

class EnglishNumberToWords
{
    public function toWords(int|string $number): string
    {
        $formatter = new NumberToWordsFormatter;

        return $formatter->formatNumber($number, 'en');
    }
}
