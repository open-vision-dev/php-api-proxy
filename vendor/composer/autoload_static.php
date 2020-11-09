<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0194150a371a378c1881f4ff27e240af
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Intervention\\HttpAuth\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Intervention\\HttpAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/httpauth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0194150a371a378c1881f4ff27e240af::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0194150a371a378c1881f4ff27e240af::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0194150a371a378c1881f4ff27e240af::$classMap;

        }, null, ClassLoader::class);
    }
}