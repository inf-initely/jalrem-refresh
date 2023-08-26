<?php

namespace App\Console\Commands;

use App\Sitemapper;
use Illuminate\Console\Command;

class GenerateBaseSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate-base';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate base sitemap (should be run once except when map is changed in Sitemapper::baseUrls()...)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Sitemapper::generateBaseSitemap();
        return 0;
    }
}
