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
    
    /**
     * @var string
     */
    private $image;
    
    /**
     * @var int
     */
    private $maxQuantity = 9999;

    /**
     * @var array 
     */
    private $infos = [];

    public function __construct(int $id, string $name, int $unitPrice, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $this->image = $image;
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

    public function getImage(): string
    {
        return $this->image;
    }
    
    public function getMaxQuantity(): int
    {
        return $this->maxQuantity;
    }

    public function setMaxQuantiy(int $maxQuantity): void
    {
        $this->maxQuantity = $maxQuantity;
    }

    public function getInfos(): array
    {
        return $this->infos;
    }

    public function addInfo(string $infos): void
    {
        $this->infos[] = $infos;
    }
    
}