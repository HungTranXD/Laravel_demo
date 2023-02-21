<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function home() {
        $orders_count = Order::count();
        $orders_sum_grand_total = Order::sum("grand_total");
        $products_count = Product::count();
        $total_quantity = DB::table("order_products")->sum("quantity");

        //Vẽ biểu đồ category - số sp
        $categories_data = Category::withCount("Products")->limit(6)->get();
        $category_names = [];
        $category_products_counts = [];
        foreach ($categories_data as $item) {
            $category_names[] = $item->name;
            $category_products_counts[] = $item->products_count;
        }
        $category_names = json_encode($category_names);
        $category_products_counts = json_encode($category_products_counts);

        //Vẽ biểu đồ order - ngày
        $last7days = [];

        $today = today();
        $last7 = today()->subDay(6);
        $last6 = today()->subDay(5);
        $last5 = today()->subDay(4);
        $last4 = today()->subDay(3);
        $last3 = today()->subDay(2);
        $last2 = today()->subDay(1);

        $today_orders = Order::whereDate("create_at", $today)->count();
        $today_last7 = Order::whereDate("create_at", $last7)->count();
        $today_last6 = Order::whereDate("create_at", $last6)->count();
        $today_last5 = Order::whereDate("create_at", $last5)->count();
        $today_last4 = Order::whereDate("create_at", $last4)->count();
        $today_last3 = Order::whereDate("create_at", $last3)->count();
        $today_last2 = Order::whereDate("create_at", $last2)->count();



        return view("welcome", compact("orders_count","orders_sum_grand_total", "products_count", "total_quantity","category_names", "category_products_counts"));
    }
    public function aboutUs() {
        //return "Hello world!";
        return view("about-us");
    }
    public function addProduct() {
        return view("add-product");
    }
    public function productList() {
        return view("product-list");
    }
}
