<?php

declare(strict_types=1);

namespace Psren\EventsauceDemo\Domain\Order;


final class DummyProduct implements OrderItem
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
    private $unitPrice;

    public function __construct(int $id, string $name, int $unitPrice)
    {
        $this->id = $id;
        $this->name = $name;
        $this->unitPrice = $unitPrice;
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }
    
}