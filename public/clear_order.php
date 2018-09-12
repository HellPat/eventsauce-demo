<?php

declare(strict_types=1);

use Psren\EventsauceDemo\Domain\Order\QuantityNotValid;
use Psren\EventsauceDemo\Domain\Product\ProductRepository;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;

require_once __DIR__.'/../src/bootstrap.php';

$order->clear();
$orderRepository->persist($order);
$session->getFlashBag()->set('success', 'Cart was cleared');

$response = new RedirectResponse('/index.php');
$response->send();
