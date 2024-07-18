<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Customer;
use App\Models\CustomerTTH;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{


    public function getCustomers()
    {
        $customer = Customer::get();

        return ApiFormatter::createApi('Data berhasil ditampilkan', $customer);
    }


    public function getCustomersDetail()
    {
        $customer = Customer::with('tth.details')->get();

        return ApiFormatter::createApi('Data berhasil ditampilkan', $customer);
    }

    public function accept(Request $request)
    {
        DB::beginTransaction();

        try {
            $customers = CustomerTTH::where('CustID', $request->CustID)->get();

            if ($customers->isEmpty()) {
                return response()->json(['error' => 'Customer TTH not found'], 404);
            }

            foreach ($customers as $customer) {
                $customer->update([
                    'Received' => 1,
                    'ReceivedDate' => now(),
                    'FailedReason' => ''
                ]);
            }

            DB::commit();

            return ApiFormatter::createApi('Customer TTH berhasil diterima', $customers);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to update Customer TTH', 'message' => $e->getMessage()], 500);
        }
    }


    public function reject(Request $request)
    {
        DB::beginTransaction();

        try {
            $customers = CustomerTTH::where('CustID', $request->CustID)->get();

            if ($customers->isEmpty()) {
                return response()->json(['error' => 'Customer TTH not found'], 404);
            }

            foreach ($customers as $customer) {
                $customer->update([
                    'Received' => 0,
                    'ReceivedDate' => now(),
                    'FailedReason' => $request->reason,
                ]);
            }
            DB::commit();
            return ApiFormatter::createApi('Gagal Terima TTH !!!', $customers);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to update Customer TTH', 'message' => $e->getMessage()], 500);
        }
    }
}
