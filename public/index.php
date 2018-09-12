<?php

declare(strict_types=1);

use Psren\EventsauceDemo\Domain\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__.'/../src/bootstrap.php';

/** @var Twig_Environment $templating */
$templating = require __DIR__.'/../src/templating.php';

$session = new Session();
$session->start();

$response = new Response(
    $templating->load('index.html.twig')->render([
        'products' => (new ProductRepository())->getAll(),
        'errors' => $session->getFlashBag()->get('error'),
    ])
);

$response->send();