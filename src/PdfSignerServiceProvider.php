<?php

namespace DevRaeph\PdfSigner;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PdfSignerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-pdf-signer')
            ->hasConfigFile()
//            ->hasViews()
//            ->hasMigration('create_skeleton_table')
//            ->hasCommand(SkeletonCommand::class)
        ;
    }
}
