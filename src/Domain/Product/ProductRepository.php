<?php

declare(strict_types=1);


namespace Psren\EventsauceDemo\Domain\Product;


use Psren\EventsauceDemo\Domain\Order\DummyProduct;

final class ProductRepository
{

    /**
     * @var DummyProduct
     */
    private $products;

    public function __construct()
    {
        $this->products = [
            new DummyProduct(1, 'Photo 1', 400, 'https://placekitten.com/300/200?a=1'),
            new DummyProduct(2, 'Photo 2', 400, 'https://placekitten.com/300/200?a=2'),
            new DummyProduct(3, 'Photo 3', 400, 'https://placekitten.com/300/200?a=3'),
        ];
    }

    /**
     * @return DummyProduct[]
     */
    public function getAll()
    {
        return $this->products;
    }
    
    public function findById(int $id): DummyProduct
    {
        $product = array_filter($this->products, function(DummyProduct $product) use ($id) {
          return $product->getId() === $id;
        });
        
        if(! $product) {
            throw new \InvalidArgumentException('Product not found.');
        }
        
        return current($product);
    }
    
}