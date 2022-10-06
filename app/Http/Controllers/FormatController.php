<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormatRequest;
use App\Http\Service\FormatService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FormatController extends Controller
{

    public function __construct(private readonly FormatService $formatService)
    {
        //
    }

    public function format(FormatRequest $request): StreamedResponse
    {
        /**
         * Send file to ValidateService for get result
         */
        $file = $request->file('file');
        $this->formatService->format($file);

        /**
         * Return file with download
         */
        return Storage::download('public/json/result.json', 'result.json');
    }

}
