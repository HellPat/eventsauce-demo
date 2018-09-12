<?php

declare(strict_types=1);

namespace Psren\EventsauceDemo\Domain\Order;


use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour\AggregateRootBehaviour;

final class Order implements AggregateRoot
{
    use AggregateRootBehaviour;
    
    private $items = [];
    
    public function addItem(int $quantity, OrderItem $item)
    {
        if ($quantity < 1) {
            throw new QuantityNotValid('Quantity must be >= 1');
        }
        
        if ($quantity > $item->getMaxQuantity()) {
            throw new QuantityNotValid(sprintf('Quantity must not be > %s', $item->getMaxQuantity()));
        }
        
        $this->recordThat(new ItemAdded(
            $item->getId(),
            $item->getName(),
            $quantity,
            $quantity * $item->getUnitPrice()
        ));
    }
    
    private function applyItemAdded(ItemAdded $event)
    {
        $this->items[$event->getId()] = [
            'id' => $event->getId(),
            'quantity' => $event->getQuantity(),
            'total' => $event->getTotal(),
        ];
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
    
    
}