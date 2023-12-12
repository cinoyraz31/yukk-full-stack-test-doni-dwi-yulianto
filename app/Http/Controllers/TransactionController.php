<?php

namespace App\Http\Controllers;

use App\Services\Transaction\CreateService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show()
    {
        return view('transaction_form');
    }

    public function create(Request $request)
    {
        $service = new CreateService($request->all());
        $service->run();

        if ($service->isError()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors([$service->errorMessage]);
        }

        return redirect()->route('transaction.show')
            ->withSuccess('You have successfully added a transaction');
    }
}
