<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Psr\Http\Message\UriInterface;
use Illuminate\Support\Str;


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
    protected $description = 'Crawl the site to generate a sitemap.xml file';


    private array $noIndexPaths = [
        '',
        '/login/github',
        '/login/google',
        '/login/facebook',
        '/login/twitter',
        '/login',
        '/register',
        '/password/reset',
        '/password/confirm',
        '/password/email',
        '/forgot-password',
        '/reset-password/*',
        '/email/verify',
        '/user/*',
        '/profile/*',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        SitemapGenerator::create(config('app.url'))
            ->shouldCrawl(function (UriInterface $url) {
                return $this->shouldIndex($url->getPath());
            })
            ->hasCrawled(function (Url $url) {
                if ($this->shouldNotIndex($url->path())) {
                    return;
                }

                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated');
    }

    private function shouldNotIndex(string $path): bool
    {
        return Str::is($this->noIndexPaths, $path);
    }

    private function shouldIndex(string $path): bool
    {
        return ! $this->shouldNotIndex($path);
    }
}
