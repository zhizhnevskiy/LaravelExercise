<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Http\Service\FormatService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ValidateController extends Controller
{

    public function __construct(private readonly FormatService $formatService)
    {
        //
    }

    public function validateData(ValidateRequest $request): BinaryFileResponse
    {
        /**
         * Send file to ValidateService for get result
         */
        $file = $request->file('validation');
        $this->formatService->format($file);

        /**
         * Return file with download
         */
        $path = Storage::disk('local')->path('public/json/result.json');
        return response()->download($path, basename($path));
    }

}
