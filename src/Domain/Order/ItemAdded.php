<?php

declare(strict_types=1);


namespace Psren\EventsauceDemo\Domain\Order;


use EventSauce\EventSourcing\Serialization\SerializableEvent;

final class ItemAdded implements SerializableEvent
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    
    /**
     * @var int
     */
    private $quantity;
    
    /**
     * @var int
     */
    private $total;

    public function __construct(int $id, string $name, int $quantity, int $total)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->total = $total;
    }

    public function toPayload(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'quantity' => (int) $this->quantity,
            'total' => (int) $this->total,
        ];
    }

    public static function fromPayload(array $payload): SerializableEvent
    {
        return new self(
            (int) $payload['id'],
            (string) $payload['name'],
            (int) $payload['quantity'],
            (int) $payload['total']
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
    
}