<?php

namespace App\Http\Controllers;

use App\Http\Service\ValidateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ValidateController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Validate request
         */
        $request->validate([
            'validation' => 'required|file|mimes:csv,txt',
        ]);

        if ($request->hasFile('validation')) {
            /**
             * Send file to ValidateService for get result
             */
            $file = $request->file('validation');
            $validate = new ValidateService();
            $result = json_encode($validate->index($file));

            Storage::put('public/result.json', $result);

            $path = Storage::disk('local')->path('public/result.json');
            return response()->download($path, basename($path));
        }
    }
}
