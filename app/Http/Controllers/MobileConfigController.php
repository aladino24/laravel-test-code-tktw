<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\CustomerTTHDetail;
use App\Models\MobileConfig;
use Illuminate\Http\Request;

class MobileConfigController extends Controller
{
    public function totalHadiah(){
            $mobileConfig = MobileConfig::first(); 

            if (!$mobileConfig) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $value = $mobileConfig->Value; 

            $items = explode('|', $value);

            $summary = [];

            foreach ($items as $item) {
                $qty = CustomerTTHDetail::where('Jenis', $item)->get();

                if ($qty->isNotEmpty()) {
                    $sum_qty = $qty->sum('Qty');
                    
                    $summary[] = [
                        'jenis' => $item,
                        'details' => $qty,
                        'sum_qty' => $sum_qty,
                    ];
                }
            }

            $totalHadiah = array_sum(array_column($summary, 'sum_qty'));

            $data = [
                'summary' => $summary,
                'total_hadiah' => $totalHadiah,
            ];

            return ApiFormatter::createApi('Data berhasil ditampilkan', $data);
        }

}
