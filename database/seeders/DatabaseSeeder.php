<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Customer User
        $customer = User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        // Categories
        $categories = collect([
            'Electronics',
            'Office & Home',
            'Accessories',
            'Audio & Music',
            'Outdoor & Travel',
        ])->map(fn ($name) => Category::factory()->create(['name' => $name]));

        // Products (2 per category)
        $products = [];
        foreach ($categories as $category) {
            $products = array_merge($products, Product::factory()->count(2)->create([
                'category_id' => $category->id,
            ])->all());
        }

        // A sample completed order for the customer
        $sampleOrder = Order::factory()->create([
            'user_id' => $customer->id,
            'total_amount' => collect($products)->take(3)->sum(fn ($p) => $p->price * 2),
        ]);

        foreach (collect($products)->take(3) as $product) {
            OrderItem::factory()->create([
                'order_id' => $sampleOrder->id,
                'product_id' => $product->id,
                'quantity' => 2,
                'unit_price' => $product->price,
            ]);
        }

        $this->command->info('Seeded: admin@example.com / password (admin)');
        $this->command->info('Seeded: customer@example.com / password (customer)');
    }
}
