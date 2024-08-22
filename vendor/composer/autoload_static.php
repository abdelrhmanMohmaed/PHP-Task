<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85e50236d850f066dc265481bdbd915d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHP_Task\\Classes\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHP_Task\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85e50236d850f066dc265481bdbd915d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85e50236d850f066dc265481bdbd915d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit85e50236d850f066dc265481bdbd915d::$classMap;

        }, null, ClassLoader::class);
    }
}
