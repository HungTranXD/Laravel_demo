<?php
//-----------------KHONG CAN CAI NAY---------------

//namespace Database\Factories;
//
//use App\Models\OrderProduct;
//use App\Models\Product;
//use Illuminate\Database\Eloquent\Factories\Factory;
//
//class OrderProductFactory extends Factory
//{
//    protected $model = OrderProduct::class;
//    /**
//     * Define the model's default state.
//     *
//     * @return array
//     */
//    public function definition()
//    {
//        $product = Product::inRandomOrder()->first();
//        $price = $product->price;
//        $quantity = $this->faker->numberBetween(1, 10);
//        return [
//            'product_id' => $product->id,
//            'quantity' => $quantity,
//            'price' => $price
//        ];
//    }
//}
