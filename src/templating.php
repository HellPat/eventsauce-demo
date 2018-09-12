<?php

declare(strict_types=1);

$loader = new Twig_Loader_Filesystem(__DIR__.'/../views');
return new Twig_Environment($loader, [
    'strict_variables' => true,
]);
