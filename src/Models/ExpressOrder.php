<?php

class ExpressOrder extends Order {
    public float $expressDeliveryFee;

    public function __construct(string $customerName, array $items = [], float $totalPrice = 0.0, OrderStatus $status = OrderStatus::PENDING, float $expressDeliveryFee = 0.0) {
        parent::__construct($customerName, $items, $totalPrice, $status);
        $this->expressDeliveryFee = $expressDeliveryFee;
    }
    /**
     * Get total price
     */
    public function totalPrice()
    {
        return parent::totalPrice() + $this->expressDeliveryFee;
    }
}