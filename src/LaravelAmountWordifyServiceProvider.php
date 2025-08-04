<?php

namespace Swatantra\LaravelAmountWordify;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Swatantra\LaravelAmountWordify\Commands\LaravelAmountWordifyCommand;

class LaravelAmountWordifyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravelamountwordify')
            ->hasConfigFile()
            ->hasCommand(LaravelAmountWordifyCommand::class);
    }
}
