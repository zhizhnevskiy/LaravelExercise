<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormatService
{
    public function format($file){
        /**
         * Read the contents of the file, form the data,
         * the trim function is applied to the element of the array used
         * (to extract whitespace patterns)
         */
        $rows = array_map('trim', file($file));

        /**
         * Delete the first line of the name of the fields:
         * email;Age range;Salary bracket;Location;Contract type;Department;Seniority
         */
        array_shift($rows);

        /**
         * Get filters for emails
         */
        $pathEmails = app_path() . '/Http/Enums/emails.json';
        $emails = json_decode(file_get_contents($pathEmails));
        $arrayEmails = [];
        foreach ($emails as $email){
            $arrayEmails[$email->email] = $email->_id;
        }

        /**
         * Get filters for attributes
         */
        $pathFilters = app_path() . '/Http/Enums/filters.json';
        $filters = json_decode(file_get_contents($pathFilters));

        /**
         * Starting format data
         */
        $data = [];
        foreach($rows as $row){
            $params = array_map('trim', explode(';', $row));

            $email = $arrayEmails[$params[0]] ?? '';

            foreach ($filters as $filter){
                foreach ($filter->values as $value) {
                    if($value->en == $params[1]){
                        $ageRange = $value->_id;
                    } elseif ($value->en == $params[2]){
                        $salaryBracket = $value->_id;
                    } elseif ($value->en == $params[3]){
                        $location = $value->_id;
                    } elseif ($value->en == $params[4]){
                        $contactType = $value->_id;
                    } elseif ($value->en == $params[5]){
                        $department = $value->_id;
                    } elseif ($value->en == $params[6]){
                        $seniority = $value->_id;
                    }
                }
            }

            $data[] = [
                'id' => $email,
                'attributes' => [
                    $ageRange ?? '',
                    $salaryBracket ?? '',
                    $location ?? '',
                    $contactType ?? '',
                    $department ?? '',
                    $seniority ?? '',
                ]
            ];
        }

        /**
         * Store json file and prepare to download this file
         */
        Storage::put('public/json/result.json', json_encode($data));

        return $data;
    }
}
