<?php

namespace App\Console\Commands;

use App\Sitemapper;
use Assert\Assertion;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateContentsSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate-contents {--force}';

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
        $force = $this->option("force");

        $lastUpdate = file_get_contents("./flags/last_sitemap_contents_update");
        Assertion::string($lastUpdate, "failed to open file, please create if first!");
        if($lastUpdate == "") {
            $lastUpdate = Carbon::now();
        }
        file_put_contents("./flags/last_sitemap_contents_update", Carbon::now());

        foreach (Sitemapper::contents() as $map) {
            if(!$force) {
                $Class = $map[2];
                if($Class::select(DB::raw(1))
                    ->where("status", "publikasi")
                    ->where("updated_at", ">=", $lastUpdate)
                    ->first() == null
                ) {
                    continue;
                }
            }
            $urls = Sitemapper::contentUrls($map[0], $map[2]);
            Sitemapper::writeSitemap($urls, "./public/sitemap/{$map[1]}.xml");
        }
        Sitemapper::generateMainSitemapIndex();
        return 0;
    }
}
