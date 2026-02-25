<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Batteries', 'description' => 'All types of batteries for home and industrial use'],
            ['name' => 'Standing Fans', 'description' => 'Pedestal and standing fans for home and office'],
            ['name' => 'Plugs', 'description' => 'Electrical plugs and connectors'],
            ['name' => 'Extension Boards', 'description' => 'Multi-socket extension boards and surge protectors'],
            ['name' => 'Adapters', 'description' => 'Power adapters and converters'],
            ['name' => 'Bulbs & Lights', 'description' => 'LED bulbs, tube lights, and energy-saving lights'],
            ['name' => 'Emergency Lights', 'description' => 'Rechargeable emergency and backup lights'],
            ['name' => 'Wires', 'description' => 'Electrical wires, cables, and conduits'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }
    }
}
