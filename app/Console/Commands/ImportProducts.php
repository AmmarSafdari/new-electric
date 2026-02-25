<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportProducts extends Command
{
    protected $signature = 'import:products {file : Path to CSV file}';
    protected $description = 'Import/upsert products from a CSV file (columns: sku, title, category_slug, brand_slug, price, stock_qty, description, warranty, is_featured)';

    public function handle(): int
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return Command::FAILURE;
        }

        $handle = fopen($file, 'r');
        $headers = array_map('trim', fgetcsv($handle));

        $required = ['sku', 'title', 'category_slug', 'price'];
        foreach ($required as $col) {
            if (!in_array($col, $headers)) {
                $this->error("Missing required column: {$col}");
                fclose($handle);
                return Command::FAILURE;
            }
        }

        $created = $updated = $errors = 0;
        $bar = $this->output->createProgressBar();
        $bar->start();

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);

            $category = Category::where('slug', trim($data['category_slug'] ?? ''))->first();
            if (!$category) {
                $this->warn("\nSkipping SKU '{$data['sku']}': category '{$data['category_slug']}' not found.");
                $errors++;
                $bar->advance();
                continue;
            }

            $brand = null;
            if (!empty($data['brand_slug'])) {
                $brand = Brand::where('slug', trim($data['brand_slug']))->first();
            }

            $title = trim($data['title']);
            $exists = Product::where('sku', trim($data['sku']))->exists();

            Product::updateOrCreate(
                ['sku' => trim($data['sku'])],
                [
                    'title'       => $title,
                    'slug'        => Str::slug($title),
                    'category_id' => $category->id,
                    'brand_id'    => $brand?->id,
                    'price'       => (float) ($data['price'] ?? 0),
                    'stock_qty'   => (int) ($data['stock_qty'] ?? 0),
                    'description' => $data['description'] ?? null,
                    'warranty'    => $data['warranty'] ?? null,
                    'is_featured' => filter_var($data['is_featured'] ?? false, FILTER_VALIDATE_BOOLEAN),
                ]
            );

            $exists ? $updated++ : $created++;
            $bar->advance();
        }

        $bar->finish();
        fclose($handle);

        $this->newLine();
        $this->info("Import complete: {$created} created, {$updated} updated, {$errors} skipped.");
        return Command::SUCCESS;
    }
}
