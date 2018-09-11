<?php

declare(strict_types=1);


namespace Psren\EventsauceDemo\Domain\Order;


final class AddItem
{

    /**
     * @var int
     */
    private $quantity;
    
    /**
     * @var OrderItem
     */
    private $item;

    public function __construct(int $quantity, OrderItem $item)
    {
        $this->quantity = $quantity;
        $this->item = $item;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return OrderItem
     */
    public function getItem(): OrderItem
    {
        return $this->item;
    }
    
}