<?php

use Swatantra\LaravelAmountWordify\Services\LaravelAmountWordify;

beforeEach(function () {
    $this->converter = new LaravelAmountWordify;
});

test('converts single digit in english', function () {
    expect($this->converter->toEnglishWords(1, 'en'))->toBe('one only');
});

test('converts single digit in nepali', function () {
    // dd($this->converter->toNepaliWords(1, 'ne'));
    expect($this->converter->toNepaliWords(1, 'ne'))->toBe('एक मात्र');
});

test('converts ten lakh in nepali', function () {
    expect($this->converter->toNepaliWords(1000000, 'ne'))->toBe('दश लाख मात्र');
});

test('converts complex number in english', function () {
    expect($this->converter->toEnglishWords(1234567, 'en'))->toBe('twelve lakh thirty four thousand five hundred and sixty seven only');
});

test('converts complex number in nepali', function () {
    expect($this->converter->toNepaliWords(1234567, 'ne'))->toBe('बारह लाख चौंतीस हजार पाँच सय र सत्तरी मात्र');
});

test('converts 99 in nepali with compound word', function () {
    expect($this->converter->toNepaliWords(99, 'ne'))->toBe('उनान्सय मात्र');
});

test('converts 199 in nepali', function () {
    expect($this->converter->toNepaliWords(199, 'ne'))->toBe('एक सय र उनान्सय मात्र');
});

test('converts 99999 in english', function () {
    expect($this->converter->toEnglishWords(99999, 'en'))->toBe('ninety nine thousand nine hundred and ninety nine only');
});

test('converts 99999 in nepali', function () {
    expect($this->converter->toNepaliWords(99999, 'ne'))->toBe('उनान्सय हजार नौ सय र उनान्सय मात्र');
});
