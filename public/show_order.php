<?php

declare(strict_types=1);

use EventSauce\EventSourcing\AggregateRootRepository;
use Psren\EventsauceDemo\Domain\Order\OrderId;

require_once __DIR__.'/../src/bootstrap.php';

/** @var AggregateRootRepository $orderRepository */
$orderRepository = require __DIR__.'/../src/order_repository.php';

$order = $orderRepository->retrieve(OrderId::fromString('86ba23ad-e3e6-4f21-84ba-3633b67469f5'));
