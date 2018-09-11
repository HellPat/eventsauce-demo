<?php

declare(strict_types=1);

use Psren\EventsauceDemo\Domain\Order\OrderId;

$orderRepository = require __DIR__.'/../src/bootstrap.php';

$item = new \Psren\EventsauceDemo\Domain\Order\DummyProduct(12, 'PHPElephant in RED', 400);

$order = $orderRepository->retrieve(OrderId::fromString('86ba23ad-e3e6-4f21-84ba-3633b67469f5'));
