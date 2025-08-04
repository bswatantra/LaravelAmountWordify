<?php

namespace Swatantra\LaravelAmountWordify\Helpers;

class NepaliNumberToWords
{
    public function toWords(int|string $number): string
    {
        $formatter = new NumberToWordsFormatter;

        return $formatter->formatNumber($number, 'ne');
    }
}
