<?php

namespace App\Console\Commands;

use App\Sitemapper;
use Illuminate\Console\Command;

class GenerateContentsSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate-contents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate contents sitemap and refresh (and generate) the index';

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
        Sitemapper::generateContentsSitemap();
        Sitemapper::generateMainSitemapIndex();
        return 0;
    }
}
