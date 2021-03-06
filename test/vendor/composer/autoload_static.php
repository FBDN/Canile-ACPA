<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb0203d396984e2fe0769413faaee9b12
{
    public static $files = array (
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fbdn\\' => 5,
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fbdn\\' => 
        array (
            0 => __DIR__ . '/..' . '/Fbdn/src',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb0203d396984e2fe0769413faaee9b12::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb0203d396984e2fe0769413faaee9b12::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb0203d396984e2fe0769413faaee9b12::$classMap;

        }, null, ClassLoader::class);
    }
}
