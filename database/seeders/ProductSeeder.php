<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $batteries  = Category::where('slug', 'batteries')->first()->id;
        $fans       = Category::where('slug', 'standing-fans')->first()->id;
        $plugs      = Category::where('slug', 'plugs')->first()->id;
        $extensions = Category::where('slug', 'extension-boards')->first()->id;
        $adapters   = Category::where('slug', 'adapters')->first()->id;
        $bulbs      = Category::where('slug', 'bulbs-lights')->first()->id;
        $emergency  = Category::where('slug', 'emergency-lights')->first()->id;
        $wires      = Category::where('slug', 'wires')->first()->id;
        $heaters    = Category::where('slug', 'heaters')->first()->id;

        $sogo      = Brand::where('slug', 'sogo')->first()->id;
        $superasia = Brand::where('slug', 'superasia')->first()->id;
        $philips   = Brand::where('slug', 'philips')->first()->id;
        $panasonic = Brand::where('slug', 'panasonic')->first()->id;
        $local     = Brand::where('slug', 'local-generic')->first()->id;
        $gfc       = Brand::where('slug', 'gfc')->first()->id;
        $osaka     = Brand::where('slug', 'osaka')->first()->id;

        $saleEnd = Carbon::now()->addHours(48);

        $products = [

            // ── BATTERIES ──────────────────────────────────────────────────────
            [
                'title' => 'Panasonic AA Alkaline Battery 4-Pack',
                'sku' => 'BAT-PAN-AA4', 'category_id' => $batteries, 'brand_id' => $panasonic,
                'price' => 380, 'stock_qty' => 200, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Panasonic AA alkaline batteries 4-pack. Long-lasting power for remotes, toys, and everyday devices. 1.5V, 3000mAh capacity.',
                'specs' => ['Voltage' => '1.5V', 'Type' => 'Alkaline', 'Pack' => '4 batteries', 'Capacity' => '3000mAh'],
            ],
            [
                'title' => 'Panasonic AAA Battery 4-Pack',
                'sku' => 'BAT-PAN-AAA4', 'category_id' => $batteries, 'brand_id' => $panasonic,
                'price' => 320, 'stock_qty' => 180, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Panasonic AAA alkaline batteries, 4-pack. Reliable power for small electronics, clocks, and remote controls.',
                'specs' => ['Voltage' => '1.5V', 'Type' => 'Alkaline', 'Pack' => '4 batteries'],
            ],
            [
                'title' => 'Sogo 9V Alkaline Battery',
                'sku' => 'BAT-SGO-9V', 'category_id' => $batteries, 'brand_id' => $sogo,
                'price' => 220, 'stock_qty' => 120, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Sogo 9V alkaline battery for smoke detectors, walkie-talkies, and musical instruments.',
                'specs' => ['Voltage' => '9V', 'Type' => 'Alkaline', 'Pack' => '1 battery'],
            ],
            [
                'title' => 'Osaka Lead Acid Battery 12V 7Ah',
                'sku' => 'BAT-OSK-12V7', 'category_id' => $batteries, 'brand_id' => $osaka,
                'price' => 2800, 'stock_qty' => 40, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Osaka sealed lead acid battery, ideal for UPS systems, emergency lights, and solar applications.',
                'specs' => ['Voltage' => '12V', 'Capacity' => '7Ah', 'Type' => 'Sealed Lead Acid', 'Weight' => '2.3kg'],
            ],
            [
                'title' => 'Rechargeable AA Battery Set with Charger',
                'sku' => 'BAT-RCH-AA4C', 'category_id' => $batteries, 'brand_id' => $local,
                'price' => 1100, 'stock_qty' => 60, 'is_featured' => false, 'warranty' => '6 months',
                'description' => '4 rechargeable AA batteries (2500mAh each) plus USB charger. Eco-friendly, rechargeable up to 1000 times.',
                'specs' => ['Voltage' => '1.2V', 'Capacity' => '2500mAh', 'Pack' => '4 + charger', 'Recharge Cycles' => '1000+'],
            ],
            [
                'title' => 'Panasonic D-Cell Battery 2-Pack',
                'sku' => 'BAT-PAN-D2', 'category_id' => $batteries, 'brand_id' => $panasonic,
                'price' => 450, 'stock_qty' => 80, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Panasonic D-cell alkaline batteries for heavy-duty devices like torches, large toys, and radios.',
                'specs' => ['Voltage' => '1.5V', 'Type' => 'Alkaline', 'Pack' => '2 batteries'],
            ],

            // ── STANDING FANS ──────────────────────────────────────────────────
            [
                'title' => 'Sogo 16-inch Pedestal Fan',
                'sku' => 'FAN-SGO-16', 'category_id' => $fans, 'brand_id' => $sogo,
                'price' => 5500, 'stock_qty' => 30, 'is_featured' => true, 'warranty' => '2 years',
                'description' => 'Sogo 16-inch pedestal fan with 3-speed settings, 180-degree rotation, and quiet motor. Energy-efficient and stylish design.',
                'specs' => ['Blade Size' => '16 inch', 'Speeds' => '3', 'Rotation' => '180°', 'Power' => '55W', 'Voltage' => '220V'],
            ],
            [
                'title' => 'Sogo 18-inch Pedestal Fan with Remote',
                'sku' => 'FAN-SGO-18R', 'category_id' => $fans, 'brand_id' => $sogo,
                'price' => 7200, 'stock_qty' => 20, 'is_featured' => true, 'warranty' => '2 years',
                'description' => 'Premium Sogo 18-inch pedestal fan with remote control, timer, sleep mode, and 5-speed settings.',
                'specs' => ['Blade Size' => '18 inch', 'Speeds' => '5', 'Rotation' => '180°', 'Power' => '70W', 'Remote' => 'Yes', 'Timer' => 'Yes'],
                'is_on_sale' => true, 'sale_price' => 5760, 'sale_ends_at' => $saleEnd,
            ],
            [
                'title' => 'SuperAsia 14-inch Stand Fan',
                'sku' => 'FAN-SA-14', 'category_id' => $fans, 'brand_id' => $superasia,
                'price' => 4200, 'stock_qty' => 25, 'is_featured' => false, 'warranty' => '2 years',
                'description' => 'SuperAsia 14-inch stand fan, compact and powerful. Perfect for bedrooms and small rooms.',
                'specs' => ['Blade Size' => '14 inch', 'Speeds' => '3', 'Power' => '45W', 'Voltage' => '220V'],
            ],
            [
                'title' => 'SuperAsia 20-inch Industrial Pedestal Fan',
                'sku' => 'FAN-SA-20IND', 'category_id' => $fans, 'brand_id' => $superasia,
                'price' => 9500, 'stock_qty' => 12, 'is_featured' => false, 'warranty' => '2 years',
                'description' => 'Heavy-duty 20-inch industrial standing fan for large spaces, workshops, and commercial use. High airflow motor.',
                'specs' => ['Blade Size' => '20 inch', 'Speeds' => '3', 'Power' => '120W', 'Voltage' => '220V', 'Use' => 'Industrial'],
            ],
            [
                'title' => 'Sogo 16-inch Rechargeable Cordless Fan',
                'sku' => 'FAN-SGO-16RC', 'category_id' => $fans, 'brand_id' => $sogo,
                'price' => 8500, 'stock_qty' => 18, 'is_featured' => true, 'warranty' => '1 year',
                'description' => 'Sogo rechargeable 16-inch fan — runs without electricity for up to 8 hours on a single charge. Perfect for load-shedding.',
                'specs' => ['Blade Size' => '16 inch', 'Battery' => 'Built-in Li-ion', 'Backup' => 'Up to 8 hours', 'Charge Time' => '4-5 hours', 'Speeds' => '3'],
            ],
            [
                'title' => 'GFC 18-inch Pedestal Fan',
                'sku' => 'FAN-GFC-18', 'category_id' => $fans, 'brand_id' => $gfc,
                'price' => 5800, 'stock_qty' => 22, 'is_featured' => false, 'warranty' => '2 years',
                'description' => 'GFC 18-inch pedestal fan with copper motor for longer life and energy efficiency.',
                'specs' => ['Blade Size' => '18 inch', 'Motor' => 'Copper wound', 'Speeds' => '3', 'Power' => '65W'],
            ],

            // ── PLUGS ──────────────────────────────────────────────────────────
            [
                'title' => 'Sogo 3-Pin Heavy Duty Plug',
                'sku' => 'PLG-SGO-3PIN', 'category_id' => $plugs, 'brand_id' => $sogo,
                'price' => 150, 'stock_qty' => 300, 'is_featured' => false, 'warranty' => null,
                'description' => 'Sogo heavy-duty 3-pin electrical plug, 13A rated. Heat-resistant body, brass pins for safe connection.',
                'specs' => ['Pins' => '3', 'Rating' => '13A / 250V', 'Material' => 'Heat-resistant plastic'],
            ],
            [
                'title' => '2-Pin Round Plug (Pack of 2)',
                'sku' => 'PLG-2PIN-RND2', 'category_id' => $plugs, 'brand_id' => $local,
                'price' => 90, 'stock_qty' => 400, 'is_featured' => false, 'warranty' => null,
                'description' => 'Standard 2-pin round electrical plugs for small appliances. Pack of 2.',
                'specs' => ['Pins' => '2 round', 'Rating' => '6A / 250V', 'Pack' => '2 plugs'],
            ],
            [
                'title' => 'Sogo Universal 3-in-1 Plug Adapter',
                'sku' => 'PLG-SGO-3IN1', 'category_id' => $plugs, 'brand_id' => $sogo,
                'price' => 180, 'stock_qty' => 200, 'is_featured' => false, 'warranty' => null,
                'description' => 'Universal 3-in-1 plug adapter converts between 3-pin flat, 3-pin round, and 2-pin plugs.',
                'specs' => ['Compatible' => '3-pin flat, 3-pin round, 2-pin', 'Rating' => '10A / 250V'],
            ],
            [
                'title' => 'Industrial 3-Pin Plug 16A',
                'sku' => 'PLG-IND-16A', 'category_id' => $plugs, 'brand_id' => $local,
                'price' => 220, 'stock_qty' => 150, 'is_featured' => false, 'warranty' => null,
                'description' => 'Heavy-duty industrial 3-pin plug rated 16A for high-power appliances like ACs and geysers.',
                'specs' => ['Pins' => '3', 'Rating' => '16A / 250V', 'Use' => 'AC, Geyser, Heavy appliances'],
            ],
            [
                'title' => 'Waterproof Outdoor Socket Cover',
                'sku' => 'PLG-WTRPRF-COV', 'category_id' => $plugs, 'brand_id' => $local,
                'price' => 120, 'stock_qty' => 180, 'is_featured' => false, 'warranty' => null,
                'description' => 'IP44-rated waterproof cover for outdoor sockets and plugs. Protects against rain and dust.',
                'specs' => ['Rating' => 'IP44', 'Material' => 'UV-resistant ABS', 'Fits' => 'Standard sockets'],
            ],

            // ── ADAPTERS ────────────────────────────────────────────────────────
            [
                'title' => 'Sogo Universal Travel Adapter',
                'sku' => 'ADP-SGO-TRV', 'category_id' => $adapters, 'brand_id' => $sogo,
                'price' => 350, 'stock_qty' => 80, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Compact Sogo travel adapter supporting EU, UK, US, and AU plug types. Ideal for international travel.',
                'specs' => ['Compatible' => 'EU, UK, US, AU', 'Rating' => '10A / 250V'],
            ],
            [
                'title' => 'USB Wall Charger Adapter 2.4A Dual Port',
                'sku' => 'ADP-USB-2P24', 'category_id' => $adapters, 'brand_id' => $sogo,
                'price' => 450, 'stock_qty' => 100, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Dual USB wall charger with 2.4A fast charging output. Compatible with all smartphones and tablets.',
                'specs' => ['Ports' => '2x USB-A', 'Output' => '2.4A per port', 'Input' => '220V', 'Compatibility' => 'Universal'],
            ],
            [
                'title' => 'Type-C Fast Charging Adapter 18W',
                'sku' => 'ADP-USBC-18W', 'category_id' => $adapters, 'brand_id' => $sogo,
                'price' => 650, 'stock_qty' => 70, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Sogo 18W USB-C fast charger adapter. Compatible with iPhone, Android, and all Type-C devices.',
                'specs' => ['Port' => 'USB-C', 'Power' => '18W', 'Protocol' => 'PD / Quick Charge 3.0', 'Input' => '220V'],
            ],
            [
                'title' => 'Multi-Country Travel Adapter with USB',
                'sku' => 'ADP-MULTI-USB', 'category_id' => $adapters, 'brand_id' => $local,
                'price' => 850, 'stock_qty' => 45, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'All-in-one travel adapter for 150+ countries with 2 USB ports and surge protection.',
                'specs' => ['Compatible' => '150+ countries', 'USB Ports' => '2', 'Surge' => 'Protected', 'Rating' => '6A / 250V'],
            ],
            [
                'title' => 'Power Converter 220V to 110V 50W',
                'sku' => 'ADP-CONV-50W', 'category_id' => $adapters, 'brand_id' => $local,
                'price' => 1200, 'stock_qty' => 30, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Step-down voltage converter for using 110V devices in Pakistan. Ideal for imported electronics.',
                'specs' => ['Input' => '220V', 'Output' => '110V', 'Power' => '50W', 'Use' => 'Small 110V electronics'],
            ],

            // ── EXTENSION BOARDS ────────────────────────────────────────────────
            [
                'title' => 'Sogo 4-Socket Extension Board 3m',
                'sku' => 'EXT-SGO-4S3M', 'category_id' => $extensions, 'brand_id' => $sogo,
                'price' => 750, 'stock_qty' => 70, 'is_featured' => true, 'warranty' => '1 year',
                'description' => 'Sogo 4-socket extension board with 3-meter cord, master switch, and surge protection.',
                'specs' => ['Sockets' => '4', 'Cord Length' => '3m', 'Surge' => 'Protected', 'Switch' => 'Master on/off'],
                'is_on_sale' => true, 'sale_price' => 575, 'sale_ends_at' => $saleEnd,
            ],
            [
                'title' => 'Sogo 6-Socket Extension Board 5m',
                'sku' => 'EXT-SGO-6S5M', 'category_id' => $extensions, 'brand_id' => $sogo,
                'price' => 1100, 'stock_qty' => 45, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Sogo 6-socket extension board with 5-meter cord and individual switches for each socket.',
                'specs' => ['Sockets' => '6', 'Cord Length' => '5m', 'Switches' => 'Individual per socket', 'Rating' => '13A'],
            ],
            [
                'title' => '4-Socket Extension Board with 2 USB Ports',
                'sku' => 'EXT-4S-2USB', 'category_id' => $extensions, 'brand_id' => $local,
                'price' => 950, 'stock_qty' => 55, 'is_featured' => false, 'warranty' => '6 months',
                'description' => '4 power sockets plus 2 USB charging ports on a 2-meter cord. Great for office and home desks.',
                'specs' => ['Sockets' => '4', 'USB Ports' => '2', 'Cord Length' => '2m', 'USB Output' => '2.1A'],
            ],
            [
                'title' => 'Surge Protector 6-Socket with Fuse',
                'sku' => 'EXT-SURGE-6S', 'category_id' => $extensions, 'brand_id' => $sogo,
                'price' => 1350, 'stock_qty' => 35, 'is_featured' => true, 'warranty' => '1 year',
                'description' => 'Professional surge protector with 6 sockets, built-in fuse, and master switch. Protects TVs, computers, and appliances.',
                'specs' => ['Sockets' => '6', 'Surge Protection' => 'Yes', 'Fuse' => '13A', 'Rating' => '3250W / 13A'],
            ],
            [
                'title' => '2-Socket Extension Cord 10m',
                'sku' => 'EXT-2S-10M', 'category_id' => $extensions, 'brand_id' => $local,
                'price' => 680, 'stock_qty' => 60, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Long 10-meter extension cord with 2 sockets. Ideal for outdoor use and reaching distant power points.',
                'specs' => ['Sockets' => '2', 'Cord Length' => '10m', 'Wire Gauge' => '1.5mm²', 'Rating' => '13A'],
            ],
            [
                'title' => 'Heavy Duty 4-Socket Industrial Extension',
                'sku' => 'EXT-IND-4S', 'category_id' => $extensions, 'brand_id' => $local,
                'price' => 1600, 'stock_qty' => 20, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Heavy-duty industrial extension board for high-power tools and equipment. Thick cables and robust sockets.',
                'specs' => ['Sockets' => '4', 'Cord Length' => '5m', 'Wire Gauge' => '2.5mm²', 'Rating' => '16A / 4000W'],
            ],

            // ── WIRES ───────────────────────────────────────────────────────────
            [
                'title' => 'Copper Wire 1.5mm Single Core (Per Meter)',
                'sku' => 'WIR-COP-1.5', 'category_id' => $wires, 'brand_id' => $local,
                'price' => 75, 'stock_qty' => 1000, 'is_featured' => false, 'warranty' => null,
                'description' => 'Pure copper electrical wire, 1.5mm², sold per meter. Suitable for lighting circuits and 5A sockets.',
                'specs' => ['Cross Section' => '1.5mm²', 'Core' => 'Single', 'Material' => 'Pure copper', 'Max Current' => '15A'],
            ],
            [
                'title' => 'Copper Wire 2.5mm Single Core (Per Meter)',
                'sku' => 'WIR-COP-2.5', 'category_id' => $wires, 'brand_id' => $local,
                'price' => 110, 'stock_qty' => 800, 'is_featured' => false, 'warranty' => null,
                'description' => 'Pure copper electrical wire, 2.5mm², sold per meter. Standard for ring main circuits and 13A sockets.',
                'specs' => ['Cross Section' => '2.5mm²', 'Core' => 'Single', 'Material' => 'Pure copper', 'Max Current' => '20A'],
            ],
            [
                'title' => 'Copper Wire 4mm Single Core (Per Meter)',
                'sku' => 'WIR-COP-4.0', 'category_id' => $wires, 'brand_id' => $local,
                'price' => 180, 'stock_qty' => 500, 'is_featured' => false, 'warranty' => null,
                'description' => 'Heavy-gauge 4mm² copper wire for AC units, geysers, and high-power circuits.',
                'specs' => ['Cross Section' => '4mm²', 'Core' => 'Single', 'Material' => 'Pure copper', 'Max Current' => '32A'],
            ],
            [
                'title' => '3-Core Flexible Cable 1.5mm (Per Meter)',
                'sku' => 'WIR-3CORE-1.5', 'category_id' => $wires, 'brand_id' => $local,
                'price' => 140, 'stock_qty' => 600, 'is_featured' => false, 'warranty' => null,
                'description' => 'Flexible 3-core PVC cable, 1.5mm², per meter. Used for extending appliance cords and wiring plugs.',
                'specs' => ['Cores' => '3 (L/N/E)', 'Cross Section' => '1.5mm²', 'Insulation' => 'PVC', 'Flexibility' => 'High flex'],
            ],
            [
                'title' => 'Cat6 Ethernet Cable 5m',
                'sku' => 'WIR-CAT6-5M', 'category_id' => $wires, 'brand_id' => $local,
                'price' => 350, 'stock_qty' => 200, 'is_featured' => false, 'warranty' => null,
                'description' => 'High-speed Cat6 ethernet patch cable, 5 meters. Supports Gigabit internet up to 1000Mbps.',
                'specs' => ['Category' => 'Cat6', 'Length' => '5m', 'Speed' => '1Gbps', 'Connector' => 'RJ45 x2'],
            ],

            // ── HEATERS ─────────────────────────────────────────────────────────
            [
                'title' => 'Sogo Fan Heater 2000W',
                'sku' => 'HTR-SGO-FAN2K', 'category_id' => $heaters, 'brand_id' => $sogo,
                'price' => 4500, 'stock_qty' => 35, 'is_featured' => true, 'warranty' => '1 year',
                'description' => 'Sogo 2000W portable fan heater with 2 heat settings and cool fan mode. Heats room quickly and evenly.',
                'specs' => ['Power' => '2000W', 'Settings' => 'Low 1000W / High 2000W / Fan', 'Safety' => 'Tip-over protection', 'Voltage' => '220V'],
                'is_on_sale' => true, 'sale_price' => 3600, 'sale_ends_at' => $saleEnd,
            ],
            [
                'title' => 'Sogo Oil Filled Room Heater 9-Fin',
                'sku' => 'HTR-SGO-OIL9', 'category_id' => $heaters, 'brand_id' => $sogo,
                'price' => 12000, 'stock_qty' => 15, 'is_featured' => false, 'warranty' => '2 years',
                'description' => 'Sogo 9-fin oil filled radiator heater with thermostat, 3 heat settings, and 24-hour timer. Silent operation.',
                'specs' => ['Power' => '2000W', 'Fins' => '9', 'Thermostat' => 'Adjustable', 'Timer' => '24-hour', 'Safety' => 'Overheat protection'],
            ],
            [
                'title' => 'Sogo Quartz Heater 800W',
                'sku' => 'HTR-SGO-QTZ8', 'category_id' => $heaters, 'brand_id' => $sogo,
                'price' => 3200, 'stock_qty' => 40, 'is_featured' => true, 'warranty' => '1 year',
                'description' => 'Compact Sogo quartz heater with instant heat, reflector, and safety guard. Ideal for small rooms.',
                'specs' => ['Power' => '800W', 'Type' => 'Quartz infrared', 'Heat Up' => 'Instant', 'Safety' => 'Safety guard mesh'],
            ],
            [
                'title' => 'SuperAsia Fan Heater 2000W',
                'sku' => 'HTR-SA-FAN2K', 'category_id' => $heaters, 'brand_id' => $superasia,
                'price' => 4200, 'stock_qty' => 28, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'SuperAsia 2000W fan heater with dual heat settings, cool air function, and overheat cutoff.',
                'specs' => ['Power' => '2000W', 'Settings' => '2 heat + fan', 'Safety' => 'Overheat cutoff', 'Voltage' => '220V'],
            ],
            [
                'title' => 'Electric Coil Room Heater 1000W',
                'sku' => 'HTR-COIL-1KW', 'category_id' => $heaters, 'brand_id' => $local,
                'price' => 2800, 'stock_qty' => 50, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Budget-friendly electric coil heater, 1000W, with reflector. Simple and effective room heating.',
                'specs' => ['Power' => '1000W', 'Type' => 'Coil element', 'Reflector' => 'Yes', 'Voltage' => '220V'],
            ],
            [
                'title' => 'Infrared Radiant Heater 1500W',
                'sku' => 'HTR-IR-1500', 'category_id' => $heaters, 'brand_id' => $local,
                'price' => 5500, 'stock_qty' => 20, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Infrared radiant heater with 3 heating elements and adjustable tilt. Provides instant warmth without drying the air.',
                'specs' => ['Power' => '1500W', 'Type' => 'Infrared radiant', 'Elements' => '3', 'Tilt' => 'Adjustable'],
            ],

            // ── BULBS & LIGHTS ──────────────────────────────────────────────────
            [
                'title' => 'Philips 12W LED Bulb E27',
                'sku' => 'BLB-PHL-12W', 'category_id' => $bulbs, 'brand_id' => $philips,
                'price' => 280, 'stock_qty' => 200, 'is_featured' => false, 'warranty' => '2 years',
                'description' => 'Philips 12W LED bulb, E27 base, daylight 6500K, 1100 lumens. Uses 80% less energy than incandescent.',
                'specs' => ['Power' => '12W', 'Base' => 'E27', 'Color Temp' => '6500K Daylight', 'Lumens' => '1100lm', 'Life' => '15000 hours'],
            ],
            [
                'title' => 'Philips 20W LED Tube Light 4ft',
                'sku' => 'TUB-PHL-20W', 'category_id' => $bulbs, 'brand_id' => $philips,
                'price' => 420, 'stock_qty' => 100, 'is_featured' => false, 'warranty' => '2 years',
                'description' => 'Philips 20W LED tube light, 4 feet, cool white 4000K, direct replacement for T8 fluorescent tubes.',
                'specs' => ['Power' => '20W', 'Length' => '4ft / 1.2m', 'Color Temp' => '4000K Cool White', 'Lumens' => '2000lm'],
            ],
            [
                'title' => 'Panasonic 9W Warm White LED Bulb',
                'sku' => 'BLB-PAN-9W', 'category_id' => $bulbs, 'brand_id' => $panasonic,
                'price' => 220, 'stock_qty' => 150, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Panasonic 9W LED bulb, warm white 3000K, 810 lumens. Long life up to 15000 hours.',
                'specs' => ['Power' => '9W', 'Base' => 'E27', 'Color Temp' => '3000K Warm White', 'Lumens' => '810lm'],
            ],
            [
                'title' => 'Sogo LED Strip Light 5m with Remote',
                'sku' => 'BLB-SGO-STRIP5', 'category_id' => $bulbs, 'brand_id' => $sogo,
                'price' => 850, 'stock_qty' => 80, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Sogo 5-meter RGB LED strip with remote control and 16 color options. Self-adhesive, cuttable, and dimmable.',
                'specs' => ['Length' => '5m', 'Colors' => 'RGB 16 colors', 'Power' => '24W', 'Remote' => 'Yes', 'Waterproof' => 'IP44'],
            ],
            [
                'title' => 'Emergency LED Tube Light 20W',
                'sku' => 'BLB-EMG-TUB20', 'category_id' => $bulbs, 'brand_id' => $local,
                'price' => 1100, 'stock_qty' => 60, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Rechargeable emergency LED tube light, works during power outages. 3-5 hour backup on full charge.',
                'specs' => ['Power' => '20W', 'Backup' => '3-5 hours', 'Battery' => 'Built-in Li-ion', 'Length' => '2ft'],
            ],

            // ── EMERGENCY LIGHTS ────────────────────────────────────────────────
            [
                'title' => 'Sogo Emergency LED Light',
                'sku' => 'EMG-SGO-LED', 'category_id' => $emergency, 'brand_id' => $sogo,
                'price' => 1200, 'stock_qty' => 55, 'is_featured' => true, 'warranty' => '1 year',
                'description' => 'Sogo rechargeable LED emergency light, 4-6 hour backup, dual brightness modes, and wall-mountable.',
                'specs' => ['Backup' => '4-6 hours', 'Brightness' => '2 modes', 'Charge' => 'Auto when power returns', 'Mount' => 'Wall / tabletop'],
            ],
            [
                'title' => 'Rechargeable Emergency Lantern',
                'sku' => 'EMG-LOC-LAN', 'category_id' => $emergency, 'brand_id' => $local,
                'price' => 750, 'stock_qty' => 40, 'is_featured' => false, 'warranty' => '6 months',
                'description' => 'Portable rechargeable lantern with carry hook, 360° lighting, and 5-8 hour backup. Great for load-shedding.',
                'specs' => ['Backup' => '5-8 hours', 'Light' => '360°', 'Hook' => 'Yes', 'Charge' => 'USB / Wall socket'],
            ],
            [
                'title' => 'Sogo Large Emergency Bulkhead Light',
                'sku' => 'EMG-SGO-BULK', 'category_id' => $emergency, 'brand_id' => $sogo,
                'price' => 1800, 'stock_qty' => 25, 'is_featured' => false, 'warranty' => '1 year',
                'description' => 'Large rechargeable LED bulkhead emergency light with auto-on during power failure. Suitable for corridors and staircases.',
                'specs' => ['Power' => '10W', 'Backup' => '3-4 hours', 'Auto On' => 'Yes on power failure', 'Mount' => 'Wall / Ceiling'],
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'title'        => $p['title'],
                'slug'         => Str::slug($p['title']),
                'sku'          => $p['sku'],
                'category_id'  => $p['category_id'],
                'brand_id'     => $p['brand_id'],
                'price'        => $p['price'],
                'stock_qty'    => $p['stock_qty'],
                'is_featured'  => $p['is_featured'],
                'warranty'     => $p['warranty'],
                'description'  => $p['description'],
                'images'       => null,
                'specs'        => isset($p['specs']) ? $p['specs'] : null,
                'sale_price'   => $p['sale_price'] ?? null,
                'is_on_sale'   => $p['is_on_sale'] ?? false,
                'sale_ends_at' => $p['sale_ends_at'] ?? null,
            ]);
        }
    }
}
