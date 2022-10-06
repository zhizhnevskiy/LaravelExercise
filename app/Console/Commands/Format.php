<?php

namespace App\Console\Commands;

use App\Http\Service\FormatService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Format extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:format {file : File to Validate and Format.} {--locale=en : Specify the locale. Default - en.}';

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
     * @return integer
     */
    public function handle(): int
    {
        $fileName = $this->argument('file');
        $locale = $this->argument('--locale');
        $filePath = public_path('storage') . '/csv/' . $fileName;

        if (file_exists($filePath)){
            /**
             * Send file to ValidateService for store file and show result
             */
            $result = $this->formatService->format($filePath, $locale);
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {
            echo "File not Found!\n";
        }

        return 0;
    }
}
