<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $batteries   = Category::where('slug', 'batteries')->first()->id;
        $fans        = Category::where('slug', 'standing-fans')->first()->id;
        $plugs       = Category::where('slug', 'plugs')->first()->id;
        $extensions  = Category::where('slug', 'extension-boards')->first()->id;
        $adapters    = Category::where('slug', 'adapters')->first()->id;
        $bulbs       = Category::where('slug', 'bulbs-lights')->first()->id;
        $emergency   = Category::where('slug', 'emergency-lights')->first()->id;
        $wires       = Category::where('slug', 'wires')->first()->id;

        $sogo      = Brand::where('slug', 'sogo')->first()->id;
        $superasia = Brand::where('slug', 'superasia')->first()->id;
        $philips   = Brand::where('slug', 'philips')->first()->id;
        $panasonic = Brand::where('slug', 'panasonic')->first()->id;
        $local     = Brand::where('slug', 'local-generic')->first()->id;

        $products = [
            ['title' => 'Panasonic AA Battery 4-Pack', 'sku' => 'BAT-PAN-AA4', 'category_id' => $batteries, 'brand_id' => $panasonic, 'price' => 350, 'stock_qty' => 100, 'is_featured' => false, 'warranty' => '1 year', 'description' => 'High-performance Panasonic AA alkaline batteries, 4-pack. Long shelf life and reliable power.'],
            ['title' => 'Sogo Rechargeable Battery Set', 'sku' => 'BAT-SGO-RCH', 'category_id' => $batteries, 'brand_id' => $sogo, 'price' => 850, 'stock_qty' => 40, 'is_featured' => false, 'warranty' => '6 months', 'description' => 'Set of 4 rechargeable AA batteries with charger included.'],
            ['title' => 'SuperAsia 16-inch Standing Fan', 'sku' => 'FAN-SA-16', 'category_id' => $fans, 'brand_id' => $superasia, 'price' => 4500, 'stock_qty' => 25, 'is_featured' => true, 'warranty' => '2 years', 'description' => 'Powerful 16-inch pedestal fan with 3-speed settings and 180-degree rotation.'],
            ['title' => 'Sogo 18-inch Pedestal Fan', 'sku' => 'FAN-SGO-18', 'category_id' => $fans, 'brand_id' => $sogo, 'price' => 5200, 'stock_qty' => 18, 'is_featured' => true, 'warranty' => '2 years', 'description' => 'Premium 18-inch standing fan with remote control and timer function.'],
            ['title' => '3-Pin Plug (Heavy Duty)', 'sku' => 'PLG-HD-3PIN', 'category_id' => $plugs, 'brand_id' => $local, 'price' => 120, 'stock_qty' => 200, 'is_featured' => false, 'warranty' => null, 'description' => 'Heavy-duty 3-pin electrical plug, 13A rated.'],
            ['title' => '2-Pin Round Plug', 'sku' => 'PLG-2PIN-RND', 'category_id' => $plugs, 'brand_id' => $local, 'price' => 60, 'stock_qty' => 300, 'is_featured' => false, 'warranty' => null, 'description' => 'Standard 2-pin round electrical plug for small appliances.'],
            ['title' => 'Sogo 4-Socket Extension Board 3m', 'sku' => 'EXT-SGO-4S3M', 'category_id' => $extensions, 'brand_id' => $sogo, 'price' => 680, 'stock_qty' => 60, 'is_featured' => true, 'warranty' => '1 year', 'description' => '4-socket extension board with 3-meter cord and surge protection.'],
            ['title' => '6-Socket Extension with USB Ports', 'sku' => 'EXT-6S-USB', 'category_id' => $extensions, 'brand_id' => $local, 'price' => 950, 'stock_qty' => 35, 'is_featured' => false, 'warranty' => '6 months', 'description' => '6 power sockets plus 2 USB charging ports, 2-meter cord.'],
            ['title' => 'Universal Travel Adapter', 'sku' => 'ADP-UNIV-TRV', 'category_id' => $adapters, 'brand_id' => $local, 'price' => 450, 'stock_qty' => 50, 'is_featured' => false, 'warranty' => null, 'description' => 'Universal travel adapter supporting EU, UK, US, and AU plug types.'],
            ['title' => 'Philips 12W LED Bulb E27', 'sku' => 'BLB-PHL-12W', 'category_id' => $bulbs, 'brand_id' => $philips, 'price' => 280, 'stock_qty' => 150, 'is_featured' => false, 'warranty' => '2 years', 'description' => 'Philips 12W LED bulb, E27 base, daylight 6500K, energy-saving.'],
            ['title' => 'Philips 20W LED Tube Light', 'sku' => 'TUB-PHL-20W', 'category_id' => $bulbs, 'brand_id' => $philips, 'price' => 420, 'stock_qty' => 80, 'is_featured' => false, 'warranty' => '2 years', 'description' => 'Philips 20W LED tube light, 4 feet, cool white, energy efficient.'],
            ['title' => 'Panasonic 9W Warm White Bulb', 'sku' => 'BLB-PAN-9W', 'category_id' => $bulbs, 'brand_id' => $panasonic, 'price' => 220, 'stock_qty' => 120, 'is_featured' => false, 'warranty' => '1 year', 'description' => 'Panasonic 9W LED bulb, warm white 3000K, long life 15000 hours.'],
            ['title' => 'Sogo Emergency LED Light', 'sku' => 'EMG-SGO-LED', 'category_id' => $emergency, 'brand_id' => $sogo, 'price' => 1200, 'stock_qty' => 45, 'is_featured' => true, 'warranty' => '1 year', 'description' => 'Rechargeable LED emergency light, 4-6 hour backup, dual brightness modes.'],
            ['title' => 'Local Rechargeable Emergency Lantern', 'sku' => 'EMG-LOC-LAN', 'category_id' => $emergency, 'brand_id' => $local, 'price' => 750, 'stock_qty' => 30, 'is_featured' => false, 'warranty' => '6 months', 'description' => 'Portable rechargeable lantern with hook, ideal for load-shedding.'],
            ['title' => 'Copper Wire 1.5mm (Per Meter)', 'sku' => 'WIR-COP-1.5', 'category_id' => $wires, 'brand_id' => $local, 'price' => 65, 'stock_qty' => 500, 'is_featured' => false, 'warranty' => null, 'description' => 'High-quality copper electrical wire, 1.5mm², sold per meter.'],
            ['title' => 'Copper Wire 2.5mm (Per Meter)', 'sku' => 'WIR-COP-2.5', 'category_id' => $wires, 'brand_id' => $local, 'price' => 95, 'stock_qty' => 400, 'is_featured' => false, 'warranty' => null, 'description' => 'Heavy-duty copper electrical wire, 2.5mm², sold per meter.'],
        ];

        foreach ($products as $p) {
            Product::create([
                'title'       => $p['title'],
                'slug'        => Str::slug($p['title']),
                'sku'         => $p['sku'],
                'category_id' => $p['category_id'],
                'brand_id'    => $p['brand_id'],
                'price'       => $p['price'],
                'stock_qty'   => $p['stock_qty'],
                'is_featured' => $p['is_featured'],
                'warranty'    => $p['warranty'],
                'description' => $p['description'],
                'images'      => null,
                'specs'       => null,
            ]);
        }
    }
}
