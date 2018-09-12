<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use EventSauce\DoctrineMessageRepository\DoctrineMessageRepository;
use EventSauce\EventSourcing\ConstructingAggregateRootRepository;
use EventSauce\EventSourcing\Serialization\ConstructingMessageSerializer;
use Psren\EventsauceDemo\Domain\Order\Order;

$config = require __DIR__.'/../config.php';

$connection = DriverManager::getConnection($config['db']);

$orderMessageRepository = new DoctrineMessageRepository(
    $connection,
    new ConstructingMessageSerializer(),
    '_order_messages'
);

$orderRepository = new ConstructingAggregateRootRepository(
    Order::class,
    $orderMessageRepository
);
