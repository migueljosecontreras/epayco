<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class KeyGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'key:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Set the application key";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $key = $this->getRandomKey();
        $appKey = 'base64:' . $key;

        if ($this->option('show')) {
            $this->line('<comment>'.$key.'</comment>');
        }

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents(
                $path,
                preg_replace('/(APP_KEY=)(\s|.*)\n/', ("APP_KEY={$appKey}\n"), file_get_contents($path))
            );
        }

        $this->info("Application key [$key] set successfully.");
    }

    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function getRandomKey()
    {
        return Str::random(64);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [ 'show', null, InputOption::VALUE_NONE, 'Simply display the key instead of modifying files.' ],
        ];
    }
}
