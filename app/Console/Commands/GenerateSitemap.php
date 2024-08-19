<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Product;
use App\Models\Post;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Add Products to sitemap
        Product::all()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(Url::create("/product/{$product->slug}")
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        });

        // Add Posts to sitemap
        Post::all()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create("/post/{$post->slug}")
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9));
        });

        // Store the sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap has been generated.');
    }
}
