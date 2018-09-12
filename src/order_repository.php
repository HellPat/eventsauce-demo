<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use EventSauce\DoctrineMessageRepository\DoctrineMessageRepository;
use EventSauce\EventSourcing\ConstructingAggregateRootRepository;
use EventSauce\EventSourcing\Serialization\ConstructingMessageSerializer;
use Psren\EventsauceDemo\Domain\Order\Order;

$config = require __DIR__.'/../config.php';

$connection = DriverManager::getConnection($config['db']);

$orderRepository = new ConstructingAggregateRootRepository(
    Order::class,
    new DoctrineMessageRepository(
        $connection,
        new ConstructingMessageSerializer(),
        '_order_messages'
    )
);

return $orderRepository;