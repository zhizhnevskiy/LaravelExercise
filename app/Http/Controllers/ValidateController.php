<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function index(Request $request){
        /**
         * Validate request
         */
        $request->validate([
            'validation' => 'required|file|mimes:csv,txt',
        ]);

        /**
         * Read the contents of the file, form the data,
         * the trim function is applied to the element of the array used
         * (to extract whitespace patterns)
         */
        $file = $request->file('validation');
        $rows = array_map('trim', file($file));

        /**
         * Delete the first line of the name of the fields:
         * email;Age range;Salary bracket;Location;Contract type;Department;Seniority
         */
        array_shift($rows);

        foreach($rows as $key=>$row){
            // теперь строку вида 1,User1,18 разделяем по запятой, удаляя лишние пробелы
            $params = array_map('trim', explode(';', $row));

        }

    }
}
