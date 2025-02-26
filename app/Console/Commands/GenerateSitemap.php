<?php

namespace App\Console\Commands;

use App\Models\Post;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sitemap.xml file with multilingual support.';

    private array $languages = ['en', 'fr', 'es']; // Define supported languages

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create();

        // Add static pages
        foreach ($this->languages as $lang) {
            $homeUrl = LaravelLocalization::getLocalizedURL($lang, route('welcome'));
            $sitemap->add(Url::create($homeUrl)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0));

        }

        // Add paginated posts
        $posts = Post::paginate(10);
        for ($page = 1; $page <= $posts->lastPage(); $page++) {
            foreach ($this->languages as $lang) {
                $postsUrl = LaravelLocalization::getLocalizedURL($lang, route('posts.index', ['page' => $page]));
                $sitemap->add(Url::create($postsUrl)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.9));
            }
        }

        // Add individual posts
        $posts = Post::all();
        foreach ($posts as $post) {
            foreach ($this->languages as $lang) {
                $url = LaravelLocalization::getLocalizedURL($lang, route('posts.show', $post->slug));
                $sitemap->add(Url::create($url)
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.8));
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
