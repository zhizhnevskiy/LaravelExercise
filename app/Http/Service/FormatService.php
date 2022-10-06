<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormatService
{
    public function format($file, $locale = 'en')
    {
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
        $headers = array_map('trim', explode(';', $rows[0]));
        array_shift($rows);

        /**
         * Get filters for emails
         */
        $emails = json_decode(Storage::disk('filters')->get('emails.json'));
        $arrayEmails = [];
        foreach ($emails as $email) {
            $arrayEmails[$email->email] = $email->_id;
        }

        /**
         * Get filters for attributes
         */
        $filters = json_decode(Storage::disk('filters')->get('filters.json'));

        /**
         * Format data
         */
        $data = [];
        foreach ($rows as $row) {
            $params = array_map('trim', explode(';', $row));
            $attrs = [];
            foreach ($headers as $key => $value) {
                $attrs[$value] = $params[$key];
            }

            $email = $arrayEmails[$params[0]] ?? '';

            $formattedAttrs = [];
            foreach ($attrs as $header => $value) {
                $foundFilterIndex = array_search(
                    $header,
                    array_column(
                        array_column($filters, 'name'), $locale
                    )
                );

                if (!array_key_exists($foundFilterIndex, $filters)) {
                    $filterValues = $filters[$foundFilterIndex]['values'];

                    $formattedAttrs['attributes'] = array_search($value, array_column($filterValues, $locale));
                }
            }

            $data[] = [
                'id' => $email,
                'attributes' => $formattedAttrs,
            ];
        }

        /**
         * Store json file and return formatted data
         */
        Storage::put('public/json/result.json', json_encode($data));

        return $data;
    }
}
