<?php

declare(strict_types=1);

namespace Psren\EventsauceDemo\Domain\Order;


use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class OrderId implements AggregateRootId
{

    /**
     * @var UuidInterface
     */
    private $uuid;

    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }
    
    public static function create(): self
    {
        return new static(Uuid::uuid4());
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public static function fromString(string $aggregateRootId): AggregateRootId
    {
        return new static(Uuid::fromString($aggregateRootId));
    }

}