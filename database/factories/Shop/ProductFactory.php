<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Product;
use Database\Seeders\LocalImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class ProductFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Product::class;

    public function definition(): array
    {
        $fakerEn = \Faker\Factory::create('en_US');
        $fakerFr = \Faker\Factory::create('fr_FR');
        $fakerEs = \Faker\Factory::create('es_ES');

        $nameEn = $fakerEn->unique()->catchPhrase();

        return [
            'name' => [
                'en' => $nameEn,
                'fr' => $fakerFr->unique()->catchPhrase(),
                'es' => $fakerEs->unique()->catchPhrase(),
            ],
            'slug' => Str::slug($nameEn),
            'sku' => $this->faker->unique()->ean8(),
            'barcode' => $this->faker->ean13(),
            'description' => $this->faker->realText(),
            'qty' => $this->faker->randomDigitNotNull(),
            'security_stock' => $this->faker->randomDigitNotNull(),
            'featured' => $this->faker->boolean(),
            'is_visible' => $this->faker->boolean(),
            'old_price' => $this->faker->randomFloat(2, 100, 500),
            'price' => $this->faker->randomFloat(2, 80, 400),
            'cost' => $this->faker->randomFloat(2, 50, 200),
            'type' => $this->faker->randomElement(['deliverable', 'downloadable']),
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }

    public function configure(): ProductFactory
    {
        return $this->afterCreating(function (Product $product) {
            try {
                $product
                    ->addMedia(LocalImages::getRandomFile())
                    ->preservingOriginal()
                    ->toMediaCollection('product-images');
            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
