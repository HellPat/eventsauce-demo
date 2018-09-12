<?php

declare(strict_types=1);

use EventSauce\EventSourcing\AggregateRootRepository;
use Psren\EventsauceDemo\Domain\Order\Order;
use Psren\EventsauceDemo\Domain\Order\OrderId;
use Psren\EventsauceDemo\Domain\Order\QuantityNotValid;
use Psren\EventsauceDemo\Domain\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__.'/../src/bootstrap.php';

$request = Request::createFromGlobals();
$session = new Session();
$session->start();

/** @var AggregateRootRepository $orderRepository */
$orderRepository = require __DIR__.'/../src/order_repository.php';
$product = (new ProductRepository())->findById((int) $request->get('product'));
$quantity = (int) $request->get('quantity');

$orderId = $request->cookies->get('order_id');

if($orderId) {
    $order = $orderRepository->retrieve(OrderId::fromString($orderId));
} else {
    $order = new Order(OrderId::create());
}

try {
    $order->addItem($quantity, $product);
    $orderRepository->persist($order);
} catch (QuantityNotValid $e) {
    $session->getFlashBag()->set('error', $e->getMessage());
}
    
$response = new RedirectResponse('/index.php');
$response->headers->setCookie(new Cookie('order_id', $order->aggregateRootId()->toString()));
$response->send();
