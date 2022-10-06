<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormatRequest;
use App\Http\Service\FormatService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FormatController extends Controller
{

    public function __construct(private readonly FormatService $formatService)
    {
        //
    }

    public function format(FormatRequest $request): BinaryFileResponse
    {
        /**
         * Send file to ValidateService for get result
         */
        $file = $request->file('validation');
        $this->formatService->format($file);

        /**
         * Return file with download
         */
        return Storage::download('public/json/result.json', 'result.json');
    }

}
