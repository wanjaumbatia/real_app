<?php

namespace App\Http\Controllers;

use App\Jobs\CustomerCsvProcess;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function customers(Request $request)
    {
        //$customers = Customer::select('name', 'phone')->get();
        return view('admin.sales.customers.index');
    }

    public function load_customers(Request $request)
    {
        $params = $request->params;
        $whereClause = $params['sac'];
        $query = DB::table('customers')->orderBy('id');
        return DataTables::queryBuilder($query)->toJson();
    }


    public function payments(Request $request)
    {
        return view('admin.sales.payments.index');
    }


    public function load_payments(Request $request)
    {
        $params = $request->params;
        $whereClause = $params['sac'];
        $query = DB::table('payments')->orderBy('id', 'desc');
        return DataTables::queryBuilder($query)->toJson();
    }

    public function import_customers(Request $request)
    {
        return view('admin.sales/customers.import');
    }

    public function upload_customers(Request $request)
    {
        if (request()->has('file')) {
            $data = file(request()->file);
            $chunks = array_chunk($data, 1000);
            // $header = ['name', 'address', 'phone', 'handler', 'branch', 'created_at'];
            $batch  = Bus::batch([])->dispatch();
            $header = [];
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);

                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new CustomerCsvProcess($data, $header));
            }

            return redirect()->to('/admin/customers');
        }

        return 'please upload a file';
    }

    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }
}
