<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
//    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'grand_total' => 0,
            'status' => 0,
            'shipping_address' => $this->faker->address,
            'customer_tel' => $this->faker->phoneNumber
        ];
    }
}
