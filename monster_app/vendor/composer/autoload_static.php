<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit42cd79f12cef054ec76913cabb054c4f
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'USPS\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'USPS\\' => 
        array (
            0 => __DIR__ . '/..' . '/vinceg/usps-php-api/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit42cd79f12cef054ec76913cabb054c4f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit42cd79f12cef054ec76913cabb054c4f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
