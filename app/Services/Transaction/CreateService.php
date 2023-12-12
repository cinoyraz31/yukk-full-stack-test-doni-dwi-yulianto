<?php

namespace App\Services\Transaction;

use App\Models\Account;
use App\Models\Transaction;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class CreateService extends BaseService
{
    private $imageUrl = null;
    private $account = null;
    public $rules = [
        'transaction_type' => 'required|in:top-up,transaction',
        'amount' => 'required|numeric',
        'description' => 'required|min:3',
        'upload_file' => 'required_if:transaction_type,==,top-up|mimes:jpg,png,jpeg|max:2048'
    ];

    public $ruleMessages = [
        'transaction_type.required' => 'transcation type is required',
        'transaction_type.in' => 'transcation type must value is top-up or transaction',
        'amount.required' => 'amount is required',
        'amount.numeric' => 'amount must numeric',
        'description.required' => 'description is required',
        'description.min' => 'description min 3 character',
        'upload_file.required' => 'file is required',
        'upload_file.mimes' => 'file must extantion jpg, png or jpeg',
        'upload_file.max' => 'file max size 2048kb'
    ];

    public function execute()
    {
        if(! $this->customValidation()) return;

        try {
            DB::beginTransaction();
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->type = $this->request['transaction_type'];
            $transaction->code = $this->hashCode();
            $transaction->amount = $this->request['amount'];
            $transaction->description = $this->request['description'];
            $transaction->image_url = $this->imageUrl;
            $transaction->save();

            $this->account->total_transaction += 1;
            $this->account->save();
            DB::commit();
        }
        catch(Exception $e) {
            DB::rollback();
            $this->errorMessage = "Failed to save transaction";
            return false;
        }
    }

    private function hashCode()
    {
        $time = time();
        switch ($this->request['transaction_type']){
            case 'top-up':
                return sprintf("TP-%s", $time);
            default:
                return sprintf("TC-%s", $time);
        }
    }

    private function customValidation()
    {
        if(! $this->uploadFileIfTypeTopUp()) return ;
        if(! $this->mustCheckBalanceAndLockSelectBeforeUpdate()) return ;

        return true;
    }

    private function uploadFileIfTypeTopUp()
    {
        if($this->request["transaction_type"] == 'top-up'){
            $file = $this->request['upload_file'];
            $mimeType = $file->getMimeType();
            $fileName = $this->HashName();
            $fileName = $fileName . '.' . str_replace("image/", "", $mimeType);
            $file->move('transaction-file',$fileName);
            $this->imageUrl = sprintf("transaction-file/%s", $fileName);
        }
        return true;
    }

    private function HashName(){
        return strtotime("now") . '_' . rand(100, 999);
    }

    private function mustCheckBalanceAndLockSelectBeforeUpdate(){
        $this->account = Account::where('user_id', Auth::id())->lockForUpdate()->first();

        if($this->request["transaction_type"] == 'transaction'){
            $this->account->balance -= $this->request["amount"];
            if($this->account->balance <= 0){
                $this->errorMessage = "Your balance is not enough";
                return false;
            }
        } else {
            $this->account->balance += $this->request["amount"];

        }
        return true;
    }
}
