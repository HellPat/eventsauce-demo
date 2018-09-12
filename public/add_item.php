<?php

declare(strict_types=1);

use Psren\EventsauceDemo\Domain\Order\Order;
use Psren\EventsauceDemo\Domain\Order\OrderId;

$orderRepository = require __DIR__.'/../src/bootstrap.php';

$item = new \Psren\EventsauceDemo\Domain\Order\DummyProduct(12, 'PHPElephant in RED', 400);

$order = new Order(OrderId::create());
$order->addItem(8, $item);
$orderRepository->persist($order);
