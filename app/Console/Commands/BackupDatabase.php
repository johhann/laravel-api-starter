<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';

    protected $description = 'Backup the database';

    protected $username;
    protected $password;
    protected $database;

    public function __construct()
    {
        parent::__construct();
        $this->username = config('database.connections.mysql.username');
        $this->password = config('database.connections.mysql.password');
        $this->database = config('database.connections.mysql.database');
    }

    public function handle()
    {

        try {
            $command = "mysqldump --user=" . $this->username ." --password=" . $this->password . " --host=" . env('DB_HOST') . " " . $this->database . "  | gzip > " . storage_path() . "/backups/" . $this->database . "_export-" . now()->format('Y-m-d') . '.gz';
            exec($command);

            $this->info('The backup has been proceed successfully.');
        } catch (\Exception $exception) {
            Log::error($exception);
            $this->error('The backup process has been failed.');
        }

    }
}
