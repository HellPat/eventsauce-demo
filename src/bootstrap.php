<?php

declare(strict_types=1);

use EventSauce\EventSourcing\AggregateRootRepository;
use Psren\EventsauceDemo\Domain\Order\Order;
use Psren\EventsauceDemo\Domain\Order\OrderId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__.'/../vendor/autoload.php';

/** @var AggregateRootRepository $orderRepository */
$orderRepository = require __DIR__.'/order_repository.php';

$request = Request::createFromGlobals();

$session = new Session();
$session->start();

$orderId = $request->cookies->get('order_id');
if($orderId) {
    $order = $orderRepository->retrieve(OrderId::fromString($orderId));
} else {
    $order = new Order(OrderId::create());
}

$templating = new Twig_Environment(new Twig_Loader_Filesystem(__DIR__.'/../views'), [
    'strict_variables' => true,
]);

$templating->addGlobal('order', $order);
