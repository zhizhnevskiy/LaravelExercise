<?php

namespace App\Console\Commands;

use App\Http\Service\ValidateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Validate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:validate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for validation data';

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
        $file = app_path() . '/Http/Data/users.csv';

        /**
         * Send file to ValidateService for get result
         */
        $validate = new ValidateService();
        $result = $validate->index($file);

        echo json_encode($result, JSON_PRETTY_PRINT);

        return 0;
    }
}
