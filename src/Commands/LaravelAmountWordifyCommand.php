<?php

namespace Swatantra\LaravelAmountWordify\Commands;

use Illuminate\Console\Command;
use Swatantra\LaravelAmountWordify\Services\LaravelAmountWordify;

class LaravelAmountWordifyCommand extends Command
{
    protected $signature = 'number:convert {number} {locale?}';

    protected $description = 'Convert a number to words with optional locale (en/ne)';

    protected LaravelAmountWordify $converter;

    public function __construct(LaravelAmountWordify $converter)
    {
        parent::__construct();
        $this->converter = $converter;
    }

    public function handle()
    {
        $number = $this->argument('number');
        $locale = $this->argument('locale') ?? null;

        $result = $this->converter->toEnglishWords($number, $locale);

        $this->info('Number in words: '.$result);

        return 0;
    }
}
