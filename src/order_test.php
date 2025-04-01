<?php
include_once "./bootstrap.php";
// Regular order
$order = new Order('John Doe', [], 0.0, OrderStatus::PENDING);
$order->addItem('Laptop', 1500.00);
sleep(1);
$order->addItem('Mouse', 25.00);
sleep(1);
$order->addItem('Keyboard', 50.00);
sleep(1);
$order->changeStatus(OrderStatus::SHIPPED);
sleep(5);
$order->changeStatus(OrderStatus::DELIVERED);
sleep(1);
Logger::Log("Order ID: {$order->id} | Total Price: $" . $order->totalPrice() . ".");
Logger::Log("----------------------------------------------------------------------");
// Express order
$expressOrder = new ExpressOrder('Jane Doe', [], 0.0, OrderStatus::PENDING, 20.00);
$expressOrder->addItem('Smartphone', 800.00);
sleep(1);
$expressOrder->addItem('Charger', 15.00);
sleep(1);
$expressOrder->addItem('Headphones', 100.00);
sleep(1);
$expressOrder->changeStatus(OrderStatus::SHIPPED);
sleep(2);
$expressOrder->changeStatus(OrderStatus::DELIVERED);
sleep(1);
Logger::Log("Express Order ID: {$expressOrder->id} | Total Price: $" . $expressOrder->totalPrice() . " (Shipping included).");