<?php

namespace App\Http\Controllers;

use App\Services\Transaction\DetailService;
use App\Services\Transaction\IndexService;
use Illuminate\Http\Request;

class BalanceHistoryController extends Controller
{
    public function index(Request $request)
    {
        $service = new IndexService($request->all());
        $service->run();
        return view('balance-histories', [
            'transactions' => $service->data,
            'search' => !empty($request["search"]) ? $request["search"] : null,
        ]);
    }

    public function detail(Request $request, $id)
    {
        $service = new DetailService(["id" => $id]);
        $service->run();

        if ($service->isError()){
            return redirect()->back()
                ->withErrors([$service->errorMessage]);
        }

        return view('balance-history', [
            'data' => $service->data,
        ]);
    }
}
