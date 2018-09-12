<?php

declare(strict_types=1);

use Psren\EventsauceDemo\Domain\Order\Order;
use Psren\EventsauceDemo\Domain\Order\OrderId;
use Psren\EventsauceDemo\Domain\Order\QuantityNotValid;
use Psren\EventsauceDemo\Domain\Product\ProductRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

require_once __DIR__.'/../src/bootstrap.php';

$request = Request::createFromGlobals();
$session = new Session();
$session->start();

$orderRepository = require __DIR__.'/../src/order_repository.php';
$product = (new ProductRepository())->findById((int) $request->get('product'));
$quantity = (int) $request->get('quantity');

$order = new Order(OrderId::create());

try {
    $order->addItem($quantity, $product);
    $orderRepository->persist($order);
} catch (QuantityNotValid $e) {
    $session->getFlashBag()->set('error', $e->getMessage());
}
    
(new RedirectResponse('/index.php'))->send();