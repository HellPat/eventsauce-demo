<?php

declare(strict_types=1);

use Psren\EventsauceDemo\Domain\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/../src/bootstrap.php';

$response = new Response(
    $templating->load('index.html.twig')->render([
        'products' => (new ProductRepository())->getAll(),
        'errorMessages' => $session->getFlashBag()->get('errorMessages'),
        'successMessages' => $session->getFlashBag()->get('successMessages'),
    ])
);

$response->send();