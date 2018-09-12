<?php

declare(strict_types=1);


namespace Psren\EventsauceDemo\Domain\Order;


use EventSauce\EventSourcing\Serialization\SerializableEvent;

final class OrderCleared implements SerializableEvent
{
    public function toPayload(): array
    {
        return [];
    }

    public static function fromPayload(array $payload): SerializableEvent
    {
        return new self();
    }
    
}