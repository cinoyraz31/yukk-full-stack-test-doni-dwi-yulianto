<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class DetailService extends BaseService
{
    public $rules = [
        'id' => 'required|numeric',
    ];

    public $ruleMessages = [
        'id.required' => 'id id required',
        'id.numeric' => 'id must numeric'
    ];

    public function execute()
    {

        $transaction = Transaction::where("user_id", Auth::id())
            ->where('id', $this->request["id"])
            ->first();

        if(empty($transaction)){
            $this->errorMessage = "Transaction not found";
            return;
        }

        $transactions = Transaction::where("user_id", Auth::id())
            ->where("id", "<=", $this->request["id"])
            ->limit(5)
            ->orderBy("id", "desc")
            ->get();

        $this->data = [
            "transaction" => $transaction,
            "transactions" => $transactions,
        ];
    }
}
