<?php

declare(strict_types=1);

use Psren\EventsauceDemo\Domain\Order\QuantityNotValid;
use Psren\EventsauceDemo\Domain\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;

require_once __DIR__.'/../src/bootstrap.php';

$product = (new ProductRepository())->findById((int) $request->get('product'));
$quantity = (int) $request->get('quantity');

try {
    $order->addItem($quantity, $product);
    $orderRepository->persist($order);
    $session->getFlashBag()->set('successMessages', sprintf('%s x "%s" added to the cart.', $quantity, $product->getName()));
} catch (QuantityNotValid $e) {
    $session->getFlashBag()->set('errorMessages', $e->getMessage());
}
    
$response = new RedirectResponse('/index.php');
$response->headers->setCookie(new Cookie('order_id', $order->aggregateRootId()->toString()));
$response->send();
