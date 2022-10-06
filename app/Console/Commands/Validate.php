<?php

namespace App\Console\Commands;

use App\Http\Service\FormatService;
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
    public function __construct(private readonly FormatService $formatService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $file = public_path('storage') . '/csv/users.csv';

        /**
         * Send file to ValidateService for store file and show result
         */
        $result = $this->formatService->format($file);

        echo json_encode($result, JSON_PRETTY_PRINT);

        return 0;
    }
}
