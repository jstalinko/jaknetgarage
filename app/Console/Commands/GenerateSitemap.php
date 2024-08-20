<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapIndex;
use App\Models\Product;
use App\Models\Post;
use App\Models\Category;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap';

    public function handle()
    {
        // Get the base URL from the .env file
        $baseUrl = env('APP_URL'); // or env('APP_URL')

        // Create separate sitemaps for products, posts, and categories
        $sitemapProduct = Sitemap::create();
        $sitemapPost = Sitemap::create();
        $sitemapCategory = Sitemap::create();

        // Add Products to product sitemap
        Product::all()->each(function (Product $product) use ($sitemapProduct, $baseUrl) {
            $sitemapProduct->add(Url::create("{$baseUrl}/product/{$product->slug}")
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        });

        // Add Posts to post sitemap
        Post::all()->each(function (Post $post) use ($sitemapPost, $baseUrl) {
            $sitemapPost->add(Url::create("{$baseUrl}/post/{$post->slug}")
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9));
        });

        // Add Categories to category sitemap
        Category::all()->each(function (Category $category) use ($sitemapCategory, $baseUrl) {
            $sitemapCategory->add(Url::create("{$baseUrl}/product?cat={$category->id}&filter=category")
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
        });

        // Store the separate sitemaps
        $sitemapProduct->writeToFile(public_path('sitemap_product.xml'));
        $sitemapPost->writeToFile(public_path('sitemap_post.xml'));
        $sitemapCategory->writeToFile(public_path('sitemap_category.xml'));

        // Create the main sitemap index
        $sitemapIndex = SitemapIndex::create()
            ->add("{$baseUrl}/sitemap_product.xml")
            ->add("{$baseUrl}/sitemap_post.xml")
            ->add("{$baseUrl}/sitemap_category.xml");

        // Store the sitemap index
        $sitemapIndex->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap and separate sitemaps have been generated.');
    }
}
