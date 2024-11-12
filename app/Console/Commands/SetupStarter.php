<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;
use Jackiedo\DotenvEditor\DotenvEditor;
use Throwable;

class SetupStarter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starter:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the starter kit for the project';

    private DotenvEditor $dotenvEditor;

    public function __construct(DotenvEditor $dotenvEditor)
    {
        parent::__construct();
        $this->dotenvEditor = $dotenvEditor;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->alert('Setting up the starter kit for the project');
        // $this->info('Clearing the cache');
        // $this->clearCache();

        $this->info('Setting up the .env file');
        $this->setupEnvFile();
    }


    /**
     * Clear the cache
     */
    private function clearCache()
    {
        $this->info('Clearing the cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        $this->info('Cache cleared');
    }

    /**
     * Setup the .env file
     */
    private function setupEnvFile()
    {
        $this->info('Setting up the .env file');
        $this->dotenvEditor->load(base_path('.env.example'));
        // File::copy(base_path('.env.example'), base_path('.env'));


        $appName = $this->ask('Enter the application name', 'Laravel Starter');
        // $dbName = $this->ask('Enter the database name', 'laravel_starter');
        // $dbUser = $this->ask('Enter the database username', 'root');
        // $dbPassword = $this->ask('Enter the database password', '');

        $this->dotenvEditor->setKey('APP_NAME', $this->quoteValue($appName));
        // $this->dotenvEditor->setKey('DB_DATABASE', $this->quoteValue($dbName));
        // $this->dotenvEditor->setKey('DB_USERNAME', $this->quoteValue($dbUser));
        // $this->dotenvEditor->setKey('DB_PASSWORD', $this->quoteValue($dbPassword));

        $this->dotenvEditor->save();

        $this->info('.env file setup completed');
    }

        /**
     * Quote the value if it contains spaces
     */
    private function quoteValue(string $value): string
    {
        return preg_match('/\s/', $value) ? "\"$value\"" : $value;
    }
}
