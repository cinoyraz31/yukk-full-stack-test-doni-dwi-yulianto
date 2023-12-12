<?php

namespace App\Http\Controllers;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $account = Account::where('user_id', Auth::id())->first();
        $balance = $account->balance;

        $transactions = Transaction::where('user_id', Auth::id())
            ->selectRaw("type, COUNT(*) as count")
            ->groupBy('type')
            ->pluck("count", "type");

        return view('dashboard', compact(
            'balance',
            'transactions'
        ));
    }
}
