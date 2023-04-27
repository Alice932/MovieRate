<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit656d65678dd55cf624394c7cf375581e
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Sunra\\PhpSimple\\HtmlDomParser' => 
            array (
                0 => __DIR__ . '/..' . '/sunra/php-simple-html-dom-parser/Src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit656d65678dd55cf624394c7cf375581e::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit656d65678dd55cf624394c7cf375581e::$classMap;

        }, null, ClassLoader::class);
    }
}
