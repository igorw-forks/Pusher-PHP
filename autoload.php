<?php

require_once __DIR__.'/vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Pusher'    => __DIR__.'/lib',
    'Buzz'      => __DIR__.'/vendor/buzz/lib',
));
$loader->register();
