<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteBackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:delete-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete backups files older than a week ago';

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
        $files = glob(storage_path('app/backups/*.sql'));
        try {
            foreach ($files as $file) {
                if (filemtime($file) < strtotime('-1 week')) {
                    unlink($file);
                }
            }
        } catch (\Throwable $th) {
            Log::error('Backups failed to delete', [
                'message' => $th->getMessage()
            ]);
        }

        Log::info('Backups deleted');
    }
}
