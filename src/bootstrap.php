<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use EventSauce\DoctrineMessageRepository\DoctrineMessageRepository;
use EventSauce\EventSourcing\ConstructingAggregateRootRepository;
use EventSauce\EventSourcing\Serialization\ConstructingMessageSerializer;
use Psren\EventsauceDemo\Domain\Order\Order;

require_once __DIR__.'/../vendor/autoload.php';

$connection = DriverManager::getConnection(['url' => 'mysql://root@localhost/eventsauce_demo']);

$orderRepository = new ConstructingAggregateRootRepository(
    Order::class,
    new DoctrineMessageRepository(
        $connection,
        new ConstructingMessageSerializer(),
        '_order_messages'
    )
);

return $orderRepository;