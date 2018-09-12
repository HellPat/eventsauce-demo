<?php

declare(strict_types=1);

use EventSauce\EventSourcing\AggregateRootRepository;
use Psren\EventsauceDemo\Domain\Order\Order;
use Psren\EventsauceDemo\Domain\Order\OrderId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__.'/../vendor/autoload.php';

/** @var AggregateRootRepository $orderRepository */
require __DIR__.'/order_repository.php';

$request = Request::createFromGlobals();

$session = new Session();
$session->start();

$storedOrderId = $request->cookies->get('order_id');
if($storedOrderId) {
    $order = $orderRepository->retrieve(OrderId::fromString($storedOrderId));
} else {
    $order = new Order(OrderId::create());
}
$orderId = $order->aggregateRootId();

$templating = new Twig_Environment(new Twig_Loader_Filesystem(__DIR__.'/../views'), [
    'strict_variables' => true,
    'debug' => true,
]);

$orderMessages = $orderMessageRepository->retrieveAll($orderId);

$orderHistoryItems = [];
foreach ($orderMessages as $message) {
    $orderHistoryItems[] = $message;
}
$orderHistory = array_reverse($orderHistoryItems);

$templating->addExtension(new Twig_Extension_Debug());
$templating->addGlobal('order', $order);
$templating->addGlobal('orderMessages', $orderMessages);
$templating->addGlobal('orderHistory', $orderHistory);
