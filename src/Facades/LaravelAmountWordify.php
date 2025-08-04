<?php

namespace Swatantra\LaravelAmountWordify\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Swatantra\LaravelAmountWordify\LaravelAmountWordify
 */
class LaravelAmountWordify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Swatantra\LaravelAmountWordify\LaravelAmountWordify::class;
    }
}
