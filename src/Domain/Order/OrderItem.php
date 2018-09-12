<?php

declare(strict_types=1);

namespace Psren\EventsauceDemo\Domain\Order;

interface OrderItem
{
    public function getId(): int;
    
    public function getName(): string;

    public function getUnitPrice(): int;
    
    public function getMaxQuantity(): int;
}