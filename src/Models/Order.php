<?php

class Order {
    private static $currentId = 1;
    public int $id;
    public string $customerName;
    public array $items;
    private float $totalPrice;
    public OrderStatus $status;

    public function __construct(string $customerName, array $items = [], float $totalPrice = 0.0, OrderStatus $status = OrderStatus::PENDING) {
        $this->id = self::$currentId;
        $this->customerName = $customerName;
        $this->items = $items;
        $this->totalPrice = $totalPrice;
        $this->status = $status;

        // Increment the static ID for the next order
        self::$currentId++;
    }
    /**
     * Get total price
     */
    public function totalPrice(){
        return $this->totalPrice;
    }
    /**
     * Add item into the order
     * @param string $item
     * @param float $price
     * @return void
     */
    public function addItem(string $item, float $price){
        $this->items[] = $item;
        $this->totalPrice += $price;
        Logger::Log("Item $item added to order. Total price is now \$$this->totalPrice.");
    }
    /**
     * Update order status
     * @param OrderStatus $status
     */
    public function changeStatus(OrderStatus $status){
        $this->status = $status;
        Logger::Log("Order status changed to [$status->value].");
    }
}