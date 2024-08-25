<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Crawler\Crawler;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $time = gmdate(DATE_ATOM);

        // Create a new sitemap
        $blogSitemap = Sitemap::create();

        $blogSitemap->add(Url::create('/')
                ->setLastModificationDate(Carbon::create($time))
                ->setPriority(1)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        $blogSitemap->add(Url::create('/contact-us')
                ->setLastModificationDate(Carbon::create($time))
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        $blogSitemap->add(Url::create('/about-us')
                ->setLastModificationDate(Carbon::create($time))
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        $blogSitemap->add(Url::create('/privacy-policy')
                ->setLastModificationDate(Carbon::create($time))
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        $blogSitemap->add(Url::create('/term-condition')
                ->setLastModificationDate(Carbon::create($time))
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
        
        $blogSitemap->add(Url::create('/blogs')
                ->setLastModificationDate(Carbon::create($time))
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        Blog::get()->each(function(Blog $post) use ($blogSitemap, $time){
            $blogSitemap->add(
                Url::create('/blog/'. $post->slug)
                ->setLastModificationDate(Carbon::create($time))
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)          
            );
        });
        // Save the sitemap to a file
        $blogSitemap->writeToFile(public_path('sitemap.xml'));
    }
}
