<?php

namespace App\Console\Commands;

use App\Sitemapper;
use Illuminate\Console\Command;

class GenerateSpicesSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate-spices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate spices sitemap';

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
        Sitemapper::generateSpicesSitemap();
        return 0;
    }
}
