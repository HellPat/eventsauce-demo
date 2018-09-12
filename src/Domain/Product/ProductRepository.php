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
        $this->products = [];

        $p1 = new DummyProduct(1, 'Photo 1', 400, 'https://placeimg.com/300/200/any?a=1');
        
        $p2 = new DummyProduct(2, 'Photo 2', 400, 'https://placeimg.com/300/200/any?a=2');
        $p2->setMaxQuantiy(3);
        $p2->addInfo('Maximum of "3" per Order');
        
        $p3 = new DummyProduct(3, 'Photo 3', 400, 'https://placeimg.com/300/200/any?a=3');
        $p4 = new DummyProduct(4, 'Photo 4', 400, 'https://placeimg.com/300/200/any?a=4');
        $p5 = new DummyProduct(5, 'Photo 5', 400, 'https://placeimg.com/300/200/any?a=5');
        
        $this->products[] = $p1;
        $this->products[] = $p2;
        $this->products[] = $p3;
        $this->products[] = $p4;
        $this->products[] = $p5;
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